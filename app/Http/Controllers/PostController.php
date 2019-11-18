<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Tag;


class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function search(Request $request){
        $search = $request->get('search');
        $posts = DB::table('posts')->where('title', 'like', '%'.$search.'%')->paginate(30);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::latest()->paginate(30);

        return view('posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.create')->with(compact('tags'));
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
            'body' => 'required|min:3|max:65535',
            'cover_image' => 'image|nullable|max:2043|mimes:jpeg, png, jpg, gif'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
            
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
            //Get just ext
            $extension = $request->file('cover_image')->guessClientExtension();
            
            //FileName to store
            $fileNameToStore = time().'.'.$extension;
            
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images/',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $post = Post::create([
            'title'         => request('title'),
            'description'   => request('description'),
            'body'          => request('body'),
            'user_id'       => auth()->id(),
            'cover_image'   => $fileNameToStore,
            'slug'          => str_slug($request->title.substr(time(), -4))
        ]);

        $post->categories()->attach(request('category'));
        $post->tags()->attach(request('tags'));


        return redirect()->route('posts.index')->with('status', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();

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
        if(auth()->user()->id !== $post->user_id){
            return redirect(route('posts.index'));
        }

        $categories = Category::all();

        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
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
            'body' => 'required|min:3|max:65535',
            'cover_image' => 'image|nullable|max:2043|mimes:jpeg, png, jpg, gif',
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
            
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
            //Get just ext
            $extension = $request->file('cover_image')->guessClientExtension();
            
            //FileName to store
            $fileNameToStore = time().'.'.$extension;
            
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images/',$fileNameToStore);
        }

        if($request->hasFile('cover_image')){
            if($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/' . $post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }
 


        $post->update(request(['title', 'description', 'body']));

        $post->categories()->sync(request('category'));
        
        $post->tags()->sync(request('tags'));

        return redirect()->route('posts.show', $post->slug)->with('status', 'Post ' . $post->title . ' is successfully updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
        $post->delete();

        return redirect()->route('posts.index')->with('status', 'Post is successfully deleted.');
    }
}
