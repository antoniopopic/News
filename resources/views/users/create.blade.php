@extends('layouts.master')

@section('content')

<h1>Create a user</h1>

<form method="POST" action="{{route('users.store')}}">
@csrf
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" name="username" placeholder="Enter username" value="{{ old('username') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Enter password" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="Enter password again" required>
    </div>

    <div class="form-group">
        <button type="submit" id="submit" class="btn btn-primary" name="submit">Create a user</button>
        <a href="{{ route('users.index')}}" class="btn btn-secondary" role="button">Back</a>
    </div>
    @include('layouts.errors')
</form>
    
@endsection