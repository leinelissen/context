<?php

namespace App\Http\Middleware;

use Closure;
use App\Room;
use Illuminate\Support\Facades\Auth;

class RoomIsOwnedByUser
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

        $room = Room::findOrFail($parameters['id']);
        $users = $room->users;

        if (!$users->contains('id', Auth::id())) {
            return redirect('/');
        }

        return $next($request);
    }
}
