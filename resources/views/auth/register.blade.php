@extends('layouts.dialog')

@section('content')
    <div class="container padding small">
        <h1>Register</h1>
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <label for="first_name">First name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>

            @if ($errors->has('first_name'))
                <strong>{{ $errors->first('first_name') }}</strong>
            @endif

            <label for="last_name">Last name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required>

            @if ($errors->has('last_name'))
                <strong>{{ $errors->first('last_name') }}</strong>
            @endif

            <label for="email">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
            @endif

            <br>

            <button type="submit">
                Register
            </button>
        </form>
    </div>
@endsection
