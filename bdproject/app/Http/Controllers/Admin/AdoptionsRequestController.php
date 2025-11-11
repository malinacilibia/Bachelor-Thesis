<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdoptionRequestRejected;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Notifications\PushUpNotification;
use App\Notifications\AdoptionApprovedMail;
use App\Notifications\AdoptionRejectedMail;
use App\Events\AdoptionStatusUpdated;



class AdoptionsRequestController extends Controller
{
    public function index()
    {
        $cereri = AdoptionRequest::with('post', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.adoptie.index', compact('cereri'));
    }

    public function show($id)
    {
        $cerere = AdoptionRequest::with('post', 'user')->findOrFail($id);
        return view('admin.adoptie.show', compact('cerere'));
    }

    public function approve($id)
    {
        $cerere = AdoptionRequest::with('user', 'post')->findOrFail($id);
        $cerere->application_status = 'approved';
        $cerere->rejection_reason = null;
        $cerere->save();

        $user = $cerere->user;
        $post = $cerere->post;

        $user->notify(new PushUpNotification(
            "Cererea ta pentru pisica {$post->title} a fost aprobată! 🎉",
            url('/home')
        ));

        event(new AdoptionStatusUpdated($user->id, $post->title));

        $user->notify(new AdoptionApprovedMail(
            $post->title,
            url('/home')
        ));

        return redirect()->route('admin.adoptie')->with('success', 'Cererea a fost aprobată cu succes!');
    }


    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);

        $cerere = AdoptionRequest::with('user', 'post')->findOrFail($id);
        $cerere->application_status = 'rejected';
        $cerere->rejection_reason = $request->input('rejection_reason');
        $cerere->save();

        $user = $cerere->user;
        $post = $cerere->post;

        event(new AdoptionRequestRejected($user->id, $post->title));

        $user->notify(new PushUpNotification(
            "Cererea ta de adopție pentru pisica {$post->title} a fost respinsă. 😿",
            url('/home')
        ));


        $user->notify(new AdoptionRejectedMail(
            $post->title,
            $cerere->rejection_reason,
            url('/home')
        ));

        return redirect()->route('admin.adoptie')->with('success', 'Cererea a fost respinsă cu succes!');
    }




}
