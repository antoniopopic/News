@extends('layouts.master')

@section('content')
<div class="row my-4">
  <div class="col">
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
    <div class="jumbotron">
      <div class="container-fluid">
        <div class="row">
        @if($posts->count())  
          @foreach ($posts as $key => $post)
            <div class="col-xl-4 col-lg-6 col-md-12">  
              <div class="card text-center">
                <div class="card-body flex-fill">
                  <a href="{{route('posts.show', $post->slug)}}" id="showPost">
                    <img src="/storage/cover_images/{{$post->cover_image}}" class="card-img-top" alt="{{$post->cover_image}}" height="200px">
                    <div class="card-body">
                      <h5 class="card-title">{{$post->title}}</h5>    
                    </div>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <h1>No posts available</h1>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
  