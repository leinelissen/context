@extends('layouts.dialog')

@section('content')
    <div class="container padding small">
        <p>An email has been sent to <b>{{ $loginRequest->user->email }}</b>. It contains a link which you can use to login.</p>
        <p>If you have not received a link, try <a href="{{ URL::to('/login') }}">logging in</a> again.</p>
    </div>
@endsection
