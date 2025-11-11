<?php

namespace App\Http\Controllers;

use App\Mail\AdoptionCertificateMail;
use App\Notifications\AppointmentApprovedMail;
use App\Notifications\AppointmentRejectedMail;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Post;
use App\Events\AdoptionStatusUpdated;
use App\Models\AdoptionRequest;
use App\Events\AppointmentStatusUpdated;
use App\Events\AppointmentFeedbackReceived;
use App\Notifications\PushUpNotification;
use App\Events\AppointmentRejected;
use App\Notifications\AppointmentStatusChangedMail;
use Illuminate\Support\Facades\Mail;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->id())->orderBy('appointment_date', 'asc')->get();

        return view('appointments.index', compact('appointments'));
    }


    public function fetchAppointments()
    {
        $appointments = Appointment::where('status', 'confirmed')->get(['appointment_date as start']);
        return response()->json($appointments);
    }

    public function create($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('appointments.create', compact('post', 'post_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date_format:Y-m-d H:i',
            'post_id' => 'required|exists:posts,id'
        ]);

        $existingRejectedAppointment = Appointment::where('user_id', auth()->id())
            ->where('post_id', $request->post_id)
            ->where('status', 'rejected')
            ->first();

        if ($existingRejectedAppointment) {
            $existingRejectedAppointment->delete();
        }

        Appointment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => 'Programarea a fost creată și este în așteptare pentru aprobare.',
            'redirect' => route('appointments.index')
        ]);
    }


    public function getUnavailableDates()
    {
        $today = now();
        $nextMonth = $today->copy()->addMonth();
        $weekends = [];

        for ($date = $today->copy(); $date <= $nextMonth; $date->addDay()) {
            if ($date->isSaturday() || $date->isSunday()) {
                $weekends[] = $date->format('Y-m-d');
            }
        }

        return response()->json($weekends);
    }


    public function getUnavailableHours($date)
    {
        $bookedHours = DB::table('appointments')
            ->whereDate('appointment_date', $date)
            ->pluck('appointment_date')
            ->map(function ($dateTime) {
                return date('H:i', strtotime($dateTime));
            })
            ->toArray();

        return response()->json($bookedHours);
    }

    public function markAsAdopted(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->adopted = true;
        $post->save();
        $appointment = \App\Models\Appointment::where('post_id', $post_id)
            ->where('status', 'approved')
            ->latest('appointment_date')
            ->first();

        if ($appointment && $appointment->user) {
            $appointment->completed = true;
            $appointment->save();
            Mail::to($appointment->user->email)->send(new AdoptionCertificateMail($appointment->user, $post));
        }


        return back()->with('success', 'Pisica a fost marcată ca adoptată!');
    }


    public function adminIndex(Request $request)
    {
        $query = Appointment::with('post', 'user')->orderBy('appointment_date', 'asc');

        if ($request->has('completed')) {
            $query->where('completed', $request->completed);
        }

        $appointments = $query->get();

        return view('admin.appointments.index', compact('appointments'));
    }


    public function approve(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        \Log::info("Updating status for Appointment ID: $id, New Status: approved");

        $appointment->status = 'approved';
        $appointment->save();

        \Log::info("Status updated successfully to: " . $appointment->status);

        event(new AppointmentStatusUpdated($appointment->user_id, $appointment->appointment_date));
        \Log::info("Event broadcasted");

        $user = \App\Models\User::find($appointment->user_id);
        $user->notify(new PushUpNotification(
            "Programarea ta din data de {$appointment->appointment_date} a fost confirmată!",
            url('/appointments')
        ));
        $user->notify(new AppointmentApprovedMail(
            $appointment->appointment_date,
            url('/appointments')
        ));

        \Log::info("AppointmentStatusUpdated event triggered for user: " . $appointment->user_id);

        return back()->with('success', 'Programarea a fost aprobată.');
    }


    public function reject(Request $request, Appointment $appointment)
    {
        \Log::info("Updating status for Appointment ID: {$appointment->id}, New Status: rejected");

        $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);

        $appointment->status = 'rejected';
        $appointment->rejection_reason = $request->rejection_reason;
        $appointment->save();

        \Log::info("Status updated successfully to: " . $appointment->status);

        event(new \App\Events\AppointmentRejected($appointment->user_id, $appointment->appointment_date));
        \Log::info("AppointmentRejected event broadcasted");

        $user = \App\Models\User::find($appointment->user_id);
        $user->notify(new \App\Notifications\PushUpNotification(
            "Programarea ta din data de {$appointment->appointment_date} a fost respinsă.",
            url('/appointments')
        ));

        $user->notify(new AppointmentRejectedMail(
            $appointment->appointment_date,
            $appointment->rejection_reason,
            url('/appointments')
        ));

        \Log::info("PushUpNotification sent to user: " . $appointment->user_id);

        return redirect()->route('admin.appointments.index')->with('success', 'Programarea a fost respinsă.');
    }


    public function addFeedback(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        \Log::info("Adding feedback for Appointment ID: $id");

        $request->validate([
            'visit_feedback' => 'required|string|max:1000',
        ]);

        $appointment->visit_feedback = $request->visit_feedback;
        $appointment->save();

        \Log::info("Feedback added successfully: " . $appointment->visit_feedback);

        event(new AppointmentFeedbackReceived($appointment->user_id, $appointment->appointment_date));
        $user = \App\Models\User::find($appointment->user_id);
        $user->notify(new PushUpNotification(
            "Ai primit un nou feedback pentru programarea din data de {$appointment->appointment_date}!",
            url('/appointments')
        ));

        \Log::info("AppointmentFeedbackReceived event triggered for user: " . $appointment->user_id);

        return back()->with('success', 'Feedback-ul a fost salvat.');
    }





}

