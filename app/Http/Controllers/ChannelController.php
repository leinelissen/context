<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->channels;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input data
        $this->validate($request, [
            "group" => "required|boolean",
            "name" => "nullable|string",
        ]);

        // Fetch current user
        $user = Auth::user();

        // Create new message
        $channel = new Channel([
            "group" => $request->group,
            "name" => $request->name
        ]);

        // Assign new message to current user
        return $user->channels()->save($channel);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return $channel->messages->load('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
