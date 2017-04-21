@extends('layouts.app')

@section('content')
    <chat-container roomid="{{ $room->id }}"></chat-container>
@endsection
