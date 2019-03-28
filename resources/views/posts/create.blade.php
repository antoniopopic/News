@extends('layouts.master')

@section('content')

<h1>Create Post</h1>

<form method="POST" action="{{ route('posts.store') }}">
@csrf

    <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'has-error' : '' }} " id="title" name="title" value="{{ old('title') }}" />
    </div>

    <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control {{ $errors->has('description') ? 'has-error' : '' }} " id="description" name="description" value="{{ old('description') }}">
    </div>

    <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control {{ $errors->has('body') ? 'has-error' : '' }} " id="body" name="body" rows="10" cols="80">{{ old('body') }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Publish</button>
        <a href="{{ route('posts.index') }}" class="btn btn-danger" role="button">Back</a>
    </div>
    @include('layouts.errors')
</form>

@endsection