@extends('layouts.default')

@section('content')
    <chat-container channelid="{{ $channel->id }}"></chat-container>
@endsection
