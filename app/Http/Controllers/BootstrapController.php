<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Channel;

class BootstrapController extends Controller
{
    /**
     * Return the requested channel within the channel view
     *
     * @param  int $id The supplied id
     * @return View
     */
    public function getChannel($id)
    {
        $channel = channel::findOrFail($id);

        return view('channel')->with('channel', $channel);
    }

    /**
     * Return an overview of all channels the user is involved with
     *
     * @return View
     */
    public function getChannels()
    {
        $channels = Auth::user()->channels->load('users')->sortByDesc('updated_at');

        return view('index')->with('channels', $channels);
    }
}
