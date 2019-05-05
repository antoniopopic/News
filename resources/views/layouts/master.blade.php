<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('layouts.header')
</head>
<body style="margin-top:70px">

@include('layouts.navbar')

<div class="container">
    @yield('content')
</div>
@include('layouts.footer')