@extends('layouts.app')

@section('content')
    <chat-container channelid="{{ $channel->id }}"></chat-container>
@endsection
