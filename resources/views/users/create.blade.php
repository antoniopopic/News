@extends('layouts.master')

@section('content')
    <form action="{{ route('users.store') }}" method="post">
    @csrf
        <div>
            <input type="text" name="username" placeholder="eg. IceCream12"><br>
        </div>
        
        <div>
            <input type="email" name="email" placeholder="eg. john@john.com"><br><br>
        </div>
        
        <div>   
            <input type="password" name="password" id="password" placeholder="********"><br><br>
        </div>
        
        <div>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="********"><br><br>
        </div>
        
        <div>
            <input type="submit" value="Add user">
        </div>
    </form>
@endsection