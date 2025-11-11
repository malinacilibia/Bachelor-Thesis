<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdoptionRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $totalUsers = User::where('is_admin', 0)->count();
        $totalAdoptions = AdoptionRequest::count();
        $usersWithAdoptionRequests = User::whereHas('adoptionRequests')->count();

        $query = User::where('is_admin', 0)
            ->withCount(['adoptionRequests', 'appointments', 'stories']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('id', $search);
            });
        }

        $utilizatori = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.utilizatori.index', compact(
            'utilizatori',
            'totalUsers',
            'totalAdoptions',
            'usersWithAdoptionRequests'
        ));
    }


    public function show($id)
    {
        $utilizator = User::where('is_admin', 0)
            ->with(['adoptionRequests.post', 'appointments', 'stories', 'donations'])
            ->findOrFail($id);

        return view('admin.utilizatori.show', compact('utilizator'));
    }
}
