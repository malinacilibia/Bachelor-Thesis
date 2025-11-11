<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pisici = Post::orderBy('created_at', 'desc')->paginate(9); // sau orice număr vrei pe pagină
        return view('admin.pisici.index', compact('pisici'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pisici.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'breed' => 'required',
            'age' => 'required',
            'behavior' => 'required',
            'gender' => 'required|in:masculin,feminin',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1999',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        if($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->breed = $request->input('breed');
        $post->age = $request->input('age');
        $post->age_category = $request->input('age_category');
        $post->behavior = $request->input('behavior');
        $post->gender = $request->input('gender');
        $post->cover_image = $fileNameToStore;
        $post->save();

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imgName = time().'_'.$image->getClientOriginalName();
                $image->storeAs('public/cat_gallery', $imgName);

                $post->images()->create([
                    'image_path' => $imgName
                ]);
            }
        }

        return redirect()->route('admin.pisici')->with('success', 'Pisica a fost adăugată!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pisica = Post::findOrFail($id);
        return view('admin.pisici.show', compact('pisica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.pisici.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'breed' => 'required|string|max:255',
            'age' => 'required|string',
            'age_category' => 'required|in:Pui,Tânăr,Adult,Senior',
            'behavior' => 'required|string|max:255',
            'gender' => 'required|in:masculin,feminin',
            'cover_image' => 'image|nullable|max:1999',
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->breed = $request->input('breed');
        $post->age = $request->input('age');
        $post->age_category = $request->input('age_category');
        $post->behavior = $request->input('behavior');
        $post->gender = $request->input('gender');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imgName = time().'_'.$image->getClientOriginalName();
                $image->storeAs('public/cat_gallery', $imgName);

                $post->images()->create([
                    'image_path' => $imgName
                ]);
            }
        }


        return redirect()->route('admin.pisici')->with('success', 'Pisica a fost actualizată!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.pisici')->with('success', 'Pisica a fost ștearsă!');

    }
}
