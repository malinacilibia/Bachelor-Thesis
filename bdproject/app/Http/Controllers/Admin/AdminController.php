<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AdoptionRequest;
use App\Models\Appointment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $approved = AdoptionRequest::where('application_status', 'approved')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $rejected = AdoptionRequest::where('application_status', 'rejected')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $pending = AdoptionRequest::where('application_status', 'pending')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $totalAdoptionRequests = $approved + $rejected + $pending;

        $confirmed = Appointment::where('status', 'approved')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $waiting = Appointment::where('status', 'pending')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $cancelled = Appointment::where('status', 'rejected')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        $totalAppointments = $confirmed + $cancelled + $waiting;

        $totalAdopted = Post::where('adopted', 1)->count();

        $monthlyAdopted = Post::where('adopted', 1)
            ->whereBetween('updated_at', [$monthStart, $monthEnd])
            ->count();

        $totalUsers = User::where('is_admin', 0)->count();
        $newUsersThisWeek = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(7))->count();

        $userRegistrationsByMonth = DB::table('users')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $months = range(1, 12);
        $userRegistrations = [];

        foreach ($months as $month) {
            $userRegistrations[] = $userRegistrationsByMonth[$month] ?? 0;
        }
        $adoptionRequestsByMonth = DB::table('adoption_requests')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $monthlyAdoptionRequests = [];
        foreach (range(1, 12) as $month) {
            $monthlyAdoptionRequests[] = $adoptionRequestsByMonth[$month] ?? 0;
        }

        $appointmentsByMonth = DB::table('appointments')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $monthlyAppointments = [];
        foreach (range(1, 12) as $month) {
            $monthlyAppointments[] = $appointmentsByMonth[$month] ?? 0;
        }

        $adoptionData = [
            'approved' => $approved,
            'rejected' => $rejected,
            'pending' => $pending,
        ];

        $appointmentData = [
            'confirmed' => $confirmed,
            'cancelled' => $cancelled,
            'waiting' => $waiting,
        ];

        $adoptedCatsByMonth = DB::table('posts')
            ->selectRaw('MONTH(updated_at) as month, COUNT(*) as total')
            ->where('adopted', 1)
            ->whereYear('updated_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(updated_at)'))
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $monthlyAdoptedCats = [];
        foreach (range(1, 12) as $month) {
            $monthlyAdoptedCats[] = $adoptedCatsByMonth[$month] ?? 0;
        }

        return view('admin.dashboard', compact(
            'approved', 'rejected', 'pending', 'totalAdoptionRequests',
            'confirmed', 'cancelled', 'waiting', 'totalAppointments',
            'totalAdopted', 'monthlyAdopted',
            'totalUsers',
            'activeUsers', 'newUsersThisWeek',
            'adoptionData', 'appointmentData',
            'userRegistrations',
            'monthlyAdoptionRequests',
            'monthlyAppointments',
            'monthlyAdoptedCats'


        ));
    }
}
