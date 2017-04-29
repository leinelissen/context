@extends('layouts.app')

@section('content')
    <div class="container padding">
        <h4>Channels</h4>
        <ul>
            @foreach($channels as $channel)
                <li>
                    <a href="{{URL::to('channel/' . $channel->id)}}">
                        #{{ $channel->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <h4>Users</h4>
    </div>
@endsection
