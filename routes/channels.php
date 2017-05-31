<?php

use App\Channel;
use App\User;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('Channel.{channel}', function ($user, Channel $channel) {
    return $channel->users->contains('id', $user->id);
});

Broadcast::channel('App.User.{userId}', function ($user, $userId) {
    return $user->id == $userId;
});
