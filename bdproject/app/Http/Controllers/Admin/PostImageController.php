<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatImage;
use Illuminate\Support\Facades\Storage;

class PostImageController extends Controller
{
    public function destroy($id)
    {
        $image = CatImage::findOrFail($id);

        if (Storage::exists('public/cat_gallery/' . $image->image_path)) {
            Storage::delete('public/cat_gallery/' . $image->image_path);
        }

        $image->delete();

        return back()->with('success', 'Imaginea a fost ștearsă.');
    }
}
