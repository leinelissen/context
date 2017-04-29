<div>
    <h2>{{$channel->name}}</h2>
    <ul>
        @foreach($channel->users as $user)
            <li>{{$user->first_name}}</li>
        @endforeach
    </ul>
    <p>
        <b>{{$channel->messages->last()->user->name}}:</b>
        {{$channel->messages->last()->message}}
    </p>
</div>
