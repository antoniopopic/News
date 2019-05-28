@extends('layouts.master')

@section('content')
<h1>Create Post</h1>

<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
@csrf

    <label for="tags">Tags:</label><br/>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" id="tagsButton" data-target="#addTag">
        Add New Tag
    </button>
    <div class="d-block my-3">
        @foreach($tags as $tag)
        <label id="showTags" class="custom-control overflow-checkbox">
            <input type="checkbox" value="{{ $tag->id }}" name="tags[]" class="overflow-control-input">
            <span class="overflow-control-indicator"></span>
            <span class="overflow-control-description">{{ $tag->name }}</span>
        </label>
        @endforeach
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

    <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }} " id="title" name="title" value="{{ old('title') }}" required />
    </div>

    <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} " id="description" name="description" value="{{ old('description') }}" required>
    </div>

    <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }} " id="article-ckeditor" name="body" rows="10" cols="80" required>{{ old('body') }}</textarea>
    </div>
    <div class="form-group">
        <label for="cover_image">Photo</label>
        <input name="cover_image" type="file" accept="image/*">
    </div>
    

    

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Publish</button>
        <a href="{{ route('posts.index') }}" class="btn btn-danger" role="button">Back</a>
    </div>
    @include('layouts.errors')
</form>
@include('tags.modal')

@endsection