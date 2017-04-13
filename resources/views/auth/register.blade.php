@extends('layouts.app')

@section('content')
    <div class="container padding small">
        <h1>Register</h1>
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <strong>{{ $errors->first('name') }}</strong>
            @endif

            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
            @endif

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            @if ($errors->has('password'))
                <strong>{{ $errors->first('password') }}</strong>
            @endif

            <label for="password-confirm">Confirm password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>

            <br>

            <button type="submit">
                Register
            </button>
        </form>
    </div>
@endsection
