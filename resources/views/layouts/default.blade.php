@extends('layouts.app')

@section('body')
    @include('components.nav')
    
    <div id="app">
        @yield('content')
    </div>
@endsection
