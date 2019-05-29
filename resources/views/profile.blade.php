@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <img src="/uploads/avatars/{{Auth::user()->avatar}}" style="width: 175px; height: 175px; float:left; border-radius:50%; margin-right:30px;">
        <h1>{{Auth::user()->username}}'s profile</h1>    
        <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="avatar"><b>Upload profile picture</b></label>
                <br>
                <input type="file" name="avatar" id="avatar" accept="image/*">
            </div>

            <div class="form-group">
                <button type="submit" id="profileSubmit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><h1>Change password</h1></div>
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                    @csrf

                    <div class="form-group{{ $errors->has('current-password') ? 'is-invalid' : '' }}">
                        <label for="new-password" class="control-label">Current Password</label>
                        <input id="current-password" type="password" class="form-control" name="current-password" required>
                    </div>

                    <div class="form-group{{ $errors->has('new-password') ? 'is-invalid' : '' }}">
                        <label for="new-password" class="control-label">New Password</label>
                        <input id="new-password" type="password" class="form-control" name="new-password" required>
                    </div>

                    <div class="form-group">
                        <label for="new-password-confirm" class="control-label">Confirm New Password</label>
                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="profileSubmit" class="btn btn-primary">
                            Change Password
                        </button>
                    </div>
                    @include('layouts.errors')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection