<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','Desc')->get();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->validate([
            'title' => 'required',
            'description' => 'required' ,
            'image' => ''
       ]);

       $imageName = '';
       if($request->file('image')){
        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();

       $file->move(public_path('image'),$imageName);

       }

       Post::create([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imageName
       ]);



       return response()->json('Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $imageName = '';
       if($request->file('image')){
        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();

       $file->move(public_path('image'),$imageName);
    }
    $post->image = $imageName;


       $post->title =  $request->title;
       $post->description =  $request->description;
       $post->save();
       return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        if (File::exists(public_path('/images/'.$post->image))) {
            File::delete(public_path('images/'.$post->image));
            return response()->json('Post photo found');

        }else{
           $path = public_path($post->image);
            return response()->json($path);
        }

    }
}
