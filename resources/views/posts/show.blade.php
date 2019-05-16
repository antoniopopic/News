@extends('layouts.master')

@section('content')
@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif
<a name="top"></a>
<a href="{{ route('posts.show', $post->id) }}">
    <h2 class="blog-post-title" id=refresh>{{ $post->title }}</h2>
</a>
<br>
<div>
<h5>{{$post->description}}</h5>
</div>
<br>

    <img style="width:100%" height="700px" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br> 
    <small>Written on {{$post->created_at->toFormattedDateString()}} by {{$post->user->username}}</small>
    
    @if(count($post->tags))
        <section style="float:right;">
            <h6 style="display:inline;">Tags:</h6>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags', $tag) }}">{{ $tag->name }}</a>
            @endforeach
        </section>
    @endif
    
    <hr width="100%">
    <!-- uredi od if do else -->
    @if ( $post->user_id == auth()->id() )
	<form action="{{ route('posts.destroy',$post->id) }}" method="POST">
		{{ method_field('DELETE') }}
		{{ csrf_field() }} 
		<div class="btn-group btn-group-lg">
			<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a>
			<button class="btn btn-danger">Delete</button>
		</div>
		<div class="btn-group float-right btn-group-lg">	
			<a class="btn btn-primary" href="{{ route('posts.index') }}">Go Back</a>
		</div>
		<hr/>
	</form>	
	@else 
		<div class="btn-group btn-group-lg">	
			<a class="btn btn-primary" href="{{ route('posts.index') }}">Go Back</a>
		</div>
		<hr/>
	@endif
	
	<div>
        {!!$post->body!!}
    </div>

	<div class="card">
            <div class="card-body">
                <form action="/posts/{{ $post->id }}/comment" method="post">
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