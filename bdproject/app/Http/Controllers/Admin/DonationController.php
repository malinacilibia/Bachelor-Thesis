<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $totalDonations = Donation::sum('amount');

        $donorsCount = Donation::distinct('user_id')->count();

        $donations = Donation::latest()->take(5)->get();

        $monthlyDonations = [];
        foreach (range(1, 12) as $month) {
            $monthlyDonations[] = Donation::whereMonth('created_at', $month)->sum('amount');
        }

        $topDonors = Donation::selectRaw('user_id, SUM(amount) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->take(5)
            ->with('user')
            ->get();

        $targetAmount = 5000;

        $progress = ($totalDonations / $targetAmount) * 100;

        return view('admin.donations.index', compact(
            'totalDonations',
            'donorsCount',
            'donations',
            'monthlyDonations',
            'topDonors',
            'targetAmount',
            'progress'
        ));
    }

}
