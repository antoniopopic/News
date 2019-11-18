@component('mail::message')
# Introduction

Welcome to News, {{$user->username}}!

Thank you for registering.


@component('mail::button', ['url' => 'http://localhost:8000/posts'])
Visit us
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
