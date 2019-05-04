@extends('layouts.master')

@section('content')
<div class="row my-4">
    <div class="col">
      <div class="jumbotron">
      <div class="container-fluid">
      <div class="row">
@foreach ($posts as $key => $post)
<div class="col-xl-4 col-lg-6 col-md-12">  
<div class="card text-center" style="margin-bottom: 10px;">
    <div class="card-body flex-fill" style="width: 20rem; height: 300px">
    <a href="{{route('posts.show', $post->id)}}" style="text-decoration:none; color:black; ">
    <img src="/storage/cover_images/{{$post->cover_image}}" class="card-img-top" alt="{{$post->cover_image}}" height="200px">
    <div class="card-body">
      <h5 class="card-title"style="overflow: hidden; display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">{{$post->title}}</h5>    
    </div>
    </a>
    </div>
    </div>
  </div>
@endforeach
</div>
</div>
</div>
</div>
</div>
{{$posts->links()}}
@endsection


<!-- <div class="card card-body flex-fill">
                A small card content.
              </div>
            </div>
            <div class="col-sm d-flex">
              <div class="card card-body flex-fill">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
              </div>
            </div>
            <div class="col-sm d-flex">
              <div class="card card-body flex-fill">
                Another small card content.
              </div> -->
            
  