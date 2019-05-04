@extends('layouts.master')

@section('content')

<h1>Create a user</h1>

<form method="POST" action="{{route('users.store')}}">
@csrf
    <div class="form-group">
        <label for="username">
            <input type="text" id="username" name="username" placeholder="Enter username">
        </label>
    </div>

    <div class="form-group">
        <label for="email">
            <input type="email" id="email" name="email" placeholder="Enter email">
        </label>
    </div>

    <div class="form-group">
        <label for="password">
            <input type="password" id="password" name="password" placeholder="Enter password">
        </label>
    </div>

    <div class="form-group">
        <label for="confirm_password">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter password again">
        </label>
    </div>

    <div class="btn btn-primary" >
        <button type="submit" id="submit" name="submit">Create a user</button>
        <a href="{{ route('users.index')}}" class="btn btn-danger" role="button">Back</a>
    </div>
    @include('layouts.errors')
</form>
    
@endsection