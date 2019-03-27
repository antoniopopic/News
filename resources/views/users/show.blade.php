@extends('layouts.master')

@section('content')
        <h2>User name: {{ $user->username }}</h2>
        <br>
        <section>Email: {{ $user->email }}</section>
        <hr>
        <form action="{{ route('users.destroy', $user->id) }}" method="post">
            @method('DELETE')
            @csrf
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm" role="button">Edit</a>
            <button class="btn btn-danger btn-sm">Delete</button>
            <a href="{{ route('users.index') }}" class="btn btn-sm" role="button">Back</a>
        </form>

@endsection