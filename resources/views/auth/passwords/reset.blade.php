@extends('layouts.app')

@section('content')
    <div class="container padding">
        <h1>Reset Password</h1>>
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif

        <form role="form" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">E-Mail Address</label>
            <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
            @endif

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            @if ($errors->has('password'))
                <strong>{{ $errors->first('password') }}</strong>
            @endif

            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>

            @if ($errors->has('password_confirmation'))
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            @endif

            <button type="submit">
                Reset Password
            </button>
        </form>
    </div>
@endsection
