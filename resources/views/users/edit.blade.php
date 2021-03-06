@extends('layouts.master')

@section('content')
<h1>Edit User</h1>

<form method="post" action="{{ route('users.update', $user->id) }}">
@method('PATCH')
@csrf
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" id="username" value="{{$user->username}}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{$user->email}}" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm password</label>
        <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">
    </div>

    <div class="form-group">
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
    </div>
    @include('layouts.errors')
</form>
@endsection