<?php

namespace App\Http\Controllers;

use App\Events\StoryApproved;
use App\Events\StoryRejected;
use App\Notifications\StoryApprovedNotification;
use App\Notifications\StoryRejectedNotification;
use Illuminate\Http\Request;
use App\Models\AdoptionStory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AdoptionStoryController extends Controller
{
    public function index()
    {
        $stories = AdoptionStory::where('status', 'approved')->latest()->get();
        return view('adoption_stories.index', compact('stories'));
    }

    public function myStories()
    {
        $stories = AdoptionStory::where('user_id', Auth::id())->latest()->get();
        return view('adoption_stories.my_stories', compact('stories'));
    }

    public function create()
    {
        return view('adoption_stories.create');
    }

    public function show($id)
    {
        $story = AdoptionStory::with('user')->findOrFail($id);
        return view('adoption_stories.show', compact('story'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stories', 'public');
        }

        AdoptionStory::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->input('content'),
            'image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('my.stories')->with('success', 'Povestea ta a fost trimisă și așteaptă aprobarea.');
    }

    public function edit($id)
    {
        $story = AdoptionStory::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('adoption_stories.edit', compact('story'));
    }

    public function update(Request $request, $id)
    {
        $story = AdoptionStory::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('stories', 'public');
            $story->image = $imagePath;
        }

        $story->title = $request->input('title');
        $story->content = $request->input('content');
        $story->status = 'pending'; // Resetăm la pending la fiecare modificare
        $story->save();

        return redirect()->route('my.stories')->with('success', 'Povestea a fost actualizată și trimisă pentru reaprobare.');
    }

    public function destroy($id)
    {
        $story = AdoptionStory::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $story->delete();

        return redirect()->route('my.stories')->with('success', 'Povestea a fost ștearsă.');
    }


    public function adminIndex()
    {
        $stories = \App\Models\AdoptionStory::latest()->get();
        return view('admin.povesti.admin_index', compact('stories'));
    }

    public function approve($id)
    {
        $story = \App\Models\AdoptionStory::findOrFail($id);
        $story->status = 'approved';
        $story->save();

        event(new StoryApproved($story->user_id, $story->title));
        $user = User::find($story->user_id);
        if ($user) {
            $user->notify(new StoryApprovedNotification($story->title));
        }
        return back()->with('success', 'Povestea a fost aprobată.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:1000',
        ]);

        $story = AdoptionStory::findOrFail($id);
        $story->status = 'rejected';
        $story->reject_reason = $request->input('reject_reason');
        $story->save();

        event(new StoryRejected($story->user_id, $story->title));


        $user = User::find($story->user_id);
        if ($user) {
            $user->notify(new StoryRejectedNotification($story->title));
        }

        return back()->with('error', 'Povestea a fost respinsă cu un motiv.');
    }
    public function adminShow($id)
    {
        $story = AdoptionStory::with('user')->findOrFail($id);
        return view('admin.povesti.show', compact('story'));
    }

}
