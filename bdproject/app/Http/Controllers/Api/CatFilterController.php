<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class CatFilterController extends Controller
{
    public function filterByAge(Request $request)
    {
        $ageCategory = $request->query('age_category');

        $posts = Post::when($ageCategory, function ($query, $ageCategory) {
            return $query->where('age_category', $ageCategory);
        })->get();

        return response()->json($posts);
    }
}
