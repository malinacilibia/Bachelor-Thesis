<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Events\ReminderNotificationEvent;
use App\Models\Appointment;

class ReminderController extends Controller
{
    public function index()
    {
        $tomorrow = Carbon::tomorrow();
        $appointments = Appointment::with(['user', 'post'])
            ->whereDate('appointment_date', $tomorrow)
            ->where('status', 'approved')
            ->get();

        return view('admin.reminders.index', compact('appointments'));
    }

    public function send(Appointment $appointment)
    {
        $appointment->load('post');
        $user = $appointment->user;

        $user->notify(new \App\Notifications\AppointmentReminderNotification($appointment));

        event(new \App\Events\ReminderNotificationEvent($user->id, $appointment));

        return back()->with('success', 'Notificare trimisă!');
    }



}
