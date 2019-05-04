<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function search(Request $request){
        $search = $request->get('search');
        $posts = DB::table('posts')->where('title', 'like', '%'.$search.'%')->paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::latest()->paginate(12);

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
        
        /* Post::create(['title', 'description', 'body', 'user_id' => auth()->id()]); */

        /* $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save(); */

        Post::create([
            'title'         => request('title'),
            'description'   => request('description'),
            'body'          => request('body'),
            'user_id'       => auth()->id(),
            'cover_image'   => $fileNameToStore
        ]);

        return redirect()->route('posts.index')/* ->withFlashMessage('Post created successfully.') */;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        //dd($post);
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
        }

        if($request->hasFile('cover_image')){
            if($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/' . $post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }   
 


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
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        
        $post->delete();

        return redirect()->route('posts.index')->withFlashMessage('Post is successfully deleted.');
    }
}
