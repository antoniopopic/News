@extends('layouts.master')

@section('content')
<!-- <a href="{{ route('posts.show', $post->title) }}">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
</a> -->
<p class="blog-post-meta"> {{ $post->created_at->toFormattedDateString() }}</p>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->username}}</small>
    <hr>
    <!-- uredi od if do else -->
    @if ( $post->user_id == auth()->id() )
	<form style="margin-top:4%" action="{{ route('posts.destroy',$post->id) }}" method="POST">
		{{ method_field('DELETE') }}
		{{ csrf_field() }} 
		<div class="btn-group btn-group-lg">
			<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info">Edit</a>
			<button class="btn btn-danger">Delete</button>
		</div>
		<div class="btn-group float-right btn-group-lg">	
			<a class="btn btn-primary" href="{{ route('posts.index') }}">Go Back</a>
		</div>
	</form>	
	@else 
		<div class="btn-group btn-group-lg">	
			<a class="btn btn-primary" href="{{ route('posts.index') }}">Go Back</a>
		</div>
	@endif
    <hr/>    
@endsection