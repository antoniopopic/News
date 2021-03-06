@extends('layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div>
    <form class="form-inline my-2 my-lg-0" action="/search" method="POST" id="searchButtonNavbar3">
    @csrf
        <input class="form-control mr-sm-2" type="search" name="q" id="search" placeholder="Search Users" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchButtonNavbar2">Search</button>
    </form>
</div>

<div class="panel-heading">
    <a href="{{ route('users.create') }}" class="btn btn-primary" role="button" id="addUser">Add new User</a>                
</div>
<div class="panel-body">
    @if($users->count() || isset($details))
    <table class="table table-striped table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.show', $user->id) }}">{{ $user->username }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm" role="button">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="well">
        <h2>No user(s). Please try again.</h2>
    </div>
    @endif              
</div>

@endsection