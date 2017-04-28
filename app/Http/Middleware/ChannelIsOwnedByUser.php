<?php

namespace App\Http\Middleware;

use Closure;
use App\Channel;
use Illuminate\Support\Facades\Auth;

class ChannelIsOwnedByUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $parameters = $request->route()->parameters();

        if (!isset($parameters['id'])) {
            return redirect('/');
        };

        $channel = Channel::findOrFail($parameters['id']);
        $users = $channel->users;

        if (!$users->contains('id', Auth::id())) {
            return redirect('/');
        }

        return $next($request);
    }
}
