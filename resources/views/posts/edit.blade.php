@extends('layouts.master')

@section('content')
<a href="{{ route('posts.show', $post->id) }}">
    <h2 class="blog-post-title" id=refresh>{{ $post->title }}</h2>
</a>
<br>
<form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
@method('PATCH')
@csrf
<div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} " id="title" name="title" value="{{ $post->title }}" required/>
</div>

<div class="form-group">
    <label for="description">Description:</label>
    <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} " id="description" name="description" value="{{ $post->description }}" required/>
</div>

<div class="form-group">
    <label for="body">Body:</label>
    <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="article-ckeditor" name="body" rows="10" cols="80" required>{{ $post->body }}</textarea>
</div>

<div class="form-group">
    <label for="cover_image">Photo</label>
    <input name="cover_image" type="file" accept="image/*">
</div>

@isset ($categories) 
    <div class="{{ $errors->has('category') ? 'is-invalid' : ''}}">
            <label for="select">Categories:</label><br/>
            <div class="select">     
            <select class="browser-default custom-select" id="category" name="category">
            @foreach ($categories as $category)
                
                    <option value="{{$category->id}}">{{$category->name}}</option>
                
            @endforeach
            </select>
        </div>
    </div>
    <hr>
@endisset

<div>
    <button type="submit" class="btn btn-primary">Confirm</button>
    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-danger" role="button">Back</a>
</div>
@include('layouts.errors')
</form>
@endsection