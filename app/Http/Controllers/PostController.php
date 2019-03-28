<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest();

        return view('posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:65535'
        ]);

        /* Post::create(['title', 'description', 'body', 'user_id' => auth()->id()]); */

        Post::create([
            'title'         => request('title'),
            'description'   => request('description'),
            'body'          => request('body'),
            'user_id'       => auth()->id()
        ]);

        return redirect()->route('posts.index')/* ->withFlashMessage('Post created successfully.') */;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => 'required|min:3|max:255',
            'body' => 'required|min:3|max:65535'
        ]);

        $post->update(request(['title', 'description', 'body']));

        return redirect()->route('posts.show', $post->id)->withFlashMessage('Post ' . $post->title . ' is successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->withFlashMessage('Post is successfully deleted.');
    }
}
