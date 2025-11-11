<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle($postId)
    {
        $user = auth()->user();
        $post = Post::findOrFail($postId);

        if ($user->hasFavorited($postId)) {
            $user->favorites()->detach($postId);
            return back()->with('success', 'Pisica a fost eliminată din favorite.');
        } else {
            $user->favorites()->attach($postId);
            return back()->with('success', 'Pisica a fost adăugată la favorite!');
        }
    }
    public function destroy($postId)
    {
        $user = Auth::user();

        $user->favorites()->detach($postId);

        return back()->with('success', 'Pisica a fost ștearsă din favorite!');
    }
    public function toggled(Post $post)
    {
        $user = auth()->user();

        if ($user->favorites()->where('post_id', $post->id)->exists()) {
            $user->favorites()->detach($post->id);
            return response()->json(['status' => 'removed']);
        } else {
            $user->favorites()->attach($post->id);
            return response()->json(['status' => 'added']);
        }
    }

}
