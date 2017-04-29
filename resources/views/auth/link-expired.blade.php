@extends('layouts.app')

@section('content')
    <div class="container padding">
        <h1>Login</h1>
        <p>This link has expired. You can try creating a new link by <a href="{{ URL::to('/login') }}">logging in</a> again.</p>
    </div>
@endsection
