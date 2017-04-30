@extends('layouts.app')

@section('body')
    <div class="dialog">
        <div class="icon">
            <img src="{{URL::to('images/context-icon-white.svg')}}">
        </div>
        @yield('content')
    </div>
@endsection
