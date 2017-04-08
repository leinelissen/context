@extends('layouts.app')

@section('content')
    <div class="container padding">
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
            @endif

            <label for="password" class="col-md-4 control-label">Password</label>
            <input id="password" type="password" name="password" required>

            @if ($errors->has('password'))
                <strong>{{ $errors->first('password') }}</strong>
            @endif

            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>

            <button type="submit" class="btn btn-primary">
                Login
            </button>

            <br>

            <a class="button" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </form>
    </div>
@endsection
