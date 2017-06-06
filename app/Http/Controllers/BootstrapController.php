<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BootstrapController extends Controller
{
    /**
     * Return the requested channel within the channel view.
     *
     * @param int $id The supplied id
     *
     * @return View
     */
    public function getChannel($id)
    {
        $channel = channel::findOrFail($id);

        return view('channel')->with('channel', $channel);
    }

    public function getLatestChannel(Request $request)
    {
        $channel = Auth::user()->channels()->orderBy('updated_at', 'desc')->first();

        return redirect('/channel/'.$channel->id);
    }
}
