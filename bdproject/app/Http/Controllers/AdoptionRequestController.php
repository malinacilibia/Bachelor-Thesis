<?php

namespace App\Http\Controllers;

use App\Events\AdoptionStatusUpdated;
use Illuminate\Http\Request;
use App\Models\AdoptionRequest;
use App\Notifications\PushUpNotification;
use App\Events\AdoptionRequestRejected;

class AdoptionRequestController extends Controller
{
    public function showForm($post_id=null)
    {
        $posts = \App\Models\Post::all();
        return view('adoptions.adoption-form', compact('posts', "post_id"));
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^[0-9+\s()-]{7,20}$/',
            'address' => 'required|string|max:255',
            'city_state' => 'required|string|max:255',
            'occupation' => 'required|string|max:100',
            'housing_type' => 'required|string',
            'is_owner' => 'required|boolean',
            'rental_pet_permission' => 'nullable|boolean',
            'secure_space' => 'required|boolean',
            'had_pets_before' => 'required|boolean',
            'past_pets_details' => 'nullable|string',
            'adoption_reason' => 'required|string|min:10',
            'understands_costs' => 'required|boolean',
            'previous_adoption' => 'required|boolean',
            'previous_adoption_details' => 'nullable|string',
            'vacation_care' => 'required|string|min:5',
            'has_other_pets' => 'required|boolean',
            'other_pets' => 'nullable|array',
            'household_allergy' => 'required|boolean',
            'home_presence' => 'required|string',
            'surrender_plan' => 'required|string|min:10',
            'covers_vet_expenses' => 'required|boolean',
            'willing_to_train' => 'required|boolean',
            'agrees_home_visits' => 'required|boolean',
            'understands_commitment' => 'required|boolean',
            'accepts_terms' => 'required|boolean',
            'additional_info' => 'nullable|string',
        ]);

        $validatedData['other_pets'] = json_encode($request->other_pets ?? []);
        $validatedData['user_id'] = auth()->id();

        AdoptionRequest::create($validatedData);

        return redirect()->back()->with('message', 'Cererea de adopție a fost trimisă cu succes!');
    }
    public function show($id)
    {
        $adoptionRequest = AdoptionRequest::with('post')->findOrFail($id);
        return view('adoptions.show', compact('adoptionRequest'));
    }
    public function updateStatus(Request $request, $id)
    {
        $adoption = AdoptionRequest::with('post')->findOrFail($id);

        \Log::info("Updating status for AdoptionRequest ID: $id, New Status: " . $request->application_status);

        $adoption->application_status = $request->application_status;
        $adoption->save();

        \Log::info("Status updated successfully to: " . $adoption->application_status);

        $user = \App\Models\User::find($adoption->user_id);

        if ($request->application_status === 'approved') {
            event(new AdoptionStatusUpdated($adoption->user_id, $adoption->post->title));

            $user->notify(new PushUpNotification(
                "Cererea ta de adopție pentru pisica {$adoption->post->title} a fost aprobată!",
                url('/home')
            ));
            $user->notify(new \App\Notifications\AdoptionApprovedMail($adoption->post->title));


            \Log::info("AdoptionStatusUpdated event triggered for user: " . $adoption->user_id);
        }

        if ($request->application_status === 'rejected') {
            // 🔔 Trimite notificare cu broadcast pentru toastr
            event(new AdoptionRequestRejected($adoption->user_id, $adoption->post->title));

            $user->notify(new PushUpNotification(
                "Cererea ta de adopție pentru pisica {$adoption->post->title} a fost respinsă.",
                url('/home')
            ));
            $user->notify(new \App\Notifications\AdoptionRejectedMail($adoption->post->title));


            \Log::info("AdoptionRequestRejected event triggered for user: " . $adoption->user_id);
        }

        return back()->with('success', 'Statusul a fost actualizat!');
    }

}
