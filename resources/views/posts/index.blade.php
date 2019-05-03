@extends('layouts.master')

@section('content')
@foreach ($posts as $key => $post)
<div class="card" style="width: 18rem;">
  <img src="/storage/cover_images/{{$post->cover_image}}" class="card-img-top" alt="{{$post->cover_image}}" width="300px" height="200px">
  <div class="card-body">
    <h5 class="card-title">{{$post->title}}</h5>
    <p class="card-text">{{$post->description}}</p>
    <a href="{{route('posts.show', $post->title)}}" class="btn btn-primary">Read More</a>
  </div>
</div>
@endforeach
@endsection