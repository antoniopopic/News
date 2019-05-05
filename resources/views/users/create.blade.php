@extends('layouts.master')

@section('content')

<h1>Create a user</h1>

<form method="POST" action="{{route('users.store')}}">
@csrf
    <div class="form-group">
        <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password again">
    </div>

    <div class="form-group">
        <button type="submit" id="submit" class="btn btn-primary" name="submit">Create a user</button>
        <a href="{{ route('users.index')}}" class="btn btn-secondary" role="button">Back</a>
    </div>
    @include('layouts.errors')
</form>
    
@endsection