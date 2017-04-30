@extends('layouts.dialog')

@section('content')
    <div class="container padding small">
        <h1>Login</h1>
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
            @endif

            <button type="submit">
                Send login link
            </button>

            <br><br>

            <a class="center" href="{{ route('register')}}">
                Do you require an account?
            </a>
        </form>
    </div>
@endsection
