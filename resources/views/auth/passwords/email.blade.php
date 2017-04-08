@extends('layouts.app')

@section('content')
    <div class="container padding">
        <h1>Reset Password</h1>
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif

        <form role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <strong>{{ $errors->first('email') }}</strong>
            @endif

            <button type="submit">
                Send Password Reset Link
            </button>
        </form>
    </div>
@endsection
