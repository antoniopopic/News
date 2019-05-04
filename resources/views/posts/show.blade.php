@extends('layouts.master')

@section('content')
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
    <hr width="100%">
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
	<div>
        {!!$post->body!!}
	</div>
	<a href="#top">Back to top</a>     
@endsection