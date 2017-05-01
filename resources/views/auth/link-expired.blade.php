@extends('layouts.dialog')

@section('content')
    <div class="container padding small">
        <p>This link has expired. You can try creating a new link by <a href="{{ URL::to('/login') }}">logging in</a> again.</p>
    </div>
@endsection
