<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields =$request->validate([
            'title'=>'required|max:255',
            'body'=>'required'
        ]);
        $post = Post::create($fields);

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
        // its show one post by its id like endpopint/posts/1 . it show id no1 1 post
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $fields =$request->validate([
            'title'=>'required|max:255',
            'body'=>'required'
        ]);
        $post->update($fields);



        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return 'This post deleted';
    }
}
