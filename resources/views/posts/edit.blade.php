@extends('layouts.master')

@section('content')
<form method="POST" action="{{ route('posts.update', $post->title) }}" enctype="multipart/form-data">
@method('PATCH')
@csrf







<div class="form-group">
    <label for="cover_image">Photo</label>
    <input name="cover_image" type="file" accept="image/*">
</div>
@include('layouts.errors')
@endsection