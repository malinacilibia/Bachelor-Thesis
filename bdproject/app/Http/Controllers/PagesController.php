<?php

namespace App\Http\Controllers;

use App\Models\AdoptionStory;
use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function index()
    {
        $posts = Post::whereIn('id', [42, 57, 52, 15])->get();
        $stories = AdoptionStory::whereIn('id', [4, 5, 6, 9])->get();

        return view('pages.index', compact('posts', 'stories'));
    }


    public function about()
    {
        $title = "About Us";
        return view('pages.about')->with('title', $title);

    } public function services()
{
    $data = array(
        'title' => 'Services',
        'services' => ['Web Design', 'Programming', 'SEO']
    );
    return view('pages.services')->with($data);
}
}
