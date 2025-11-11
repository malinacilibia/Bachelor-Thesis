<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatBreedController extends Controller
{
    public function showForm()
    {
        return view('admin.predictions.cat_breed_form');
    }

    public function getPrediction(Request $request)
    {
        return response()->json(['message' => 'Predicția a fost procesată cu succes.']);
    }
}
