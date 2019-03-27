@extends('layouts.master')

@section('content')
<div class="panel-heading">
    <a href="{{ route('users.create') }}" class="btn btn-primary" role="button" style="margin-top:25px; margin-bottom:10px;">Add new User</a>                
</div>

<div class="panel-body">
    @if($users->count())
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
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="well">
        <h3>U bazi trenutno nema usera.</h3>
    </div>
    @endif              
</div>

@endsection