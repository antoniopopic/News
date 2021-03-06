@extends('layouts.master')

@section('content')
@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif
<a name="top"></a>
<a href="{{ route('posts.show', $post->slug) }}">
    <h2 class="blog-post-title" id=refresh>{{ $post->title }}</h2>
</a>
<br>
<div>
<h5>{{$post->description}}</h5>
</div>
<br>

    <img height="700px" id="showImage" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br> 
    <small>Written on {{$post->created_at->toFormattedDateString()}} by {{$post->user->username}}</small>
    
    @if(count($post->tags))
        <section id="tagsButton">
            <h6 id="showTags">Tags:</h6>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags', $tag) }}">{{ $tag->name }}</a>
            @endforeach
        </section>
    @endif
    
    <hr width="100%">
    @if ($post->user_id == auth()->id() || Auth::user()->hasRole('admin'))
	<form action="{{ route('posts.destroy',$post->slug) }}" method="POST">
		@method('DELETE')
		@csrf 
		<div class="btn-group btn-group-lg float-right">
			<a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-primary">Edit</a>
			<button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
		</div>
	</form>	
	@endif
		<div class="btn-group btn-group-lg">	
			<a class="btn btn-info" href="{{ route('posts.index') }}">Go Back</a>
		</div>
		<hr/>
	
	<div>
        {!!$post->body!!}
    </div>
    <hr>
	<div class="card">
            <div class="card-body">
                <form action="/posts/{{ $post->slug }}/comment" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" placeholder="Your comment here" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                </form>                
            </div>
        </div>

        @if (count($post->comments))
            <hr />
            <div class="comments">
                <h3>Comments:</h3>
                <ul>
                    @foreach($post->comments as $comment)

                        <li class="list-group-item">
                            <img src="/uploads/avatars/{{$comment->user->avatar}}" id="commentImage">&nbsp;  
                            <b>{{ $comment->user->username }},</b>&nbsp;
                            <i>{{ $comment->created_at->diffForHumans() }}</i>:&nbsp;
                            {{ $comment->body }}
                        </li>
                        
                    @endforeach
                </ul>            
            </div>
        @else
            <hr />
            <p>This post still doesnt have any comments! Be the first to comment.</p>
        @endif

	<hr>
	<a href="#top">Back to top</a>     
@endsection