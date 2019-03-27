@extends('layouts.master')

@section('content')
<h1>Edit User</h1>

<form method="post" action="{{ route('users.update', $user->id) }}">
@method('PATCH')
@csrf
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{$user->username}}">
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{$user->email}}">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="field">
        <label for="confirm_password">Confirm password</label>
        <input type="password" name="confirm_password" id="confirm_password">
    </div>

    <div class="form-group">
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{route('users.index')}}" class="btn">Back</a>
    </div>

</form>
@endsection