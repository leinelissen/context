<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Events\MessageCreated;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input data
        $this->validate($request, [
            'message'    => 'required|string',
            'channel_id' => 'required|integer',
        ]);

        // Fetch current user and designated channel
        $user = Auth::user();
        $channel = Channel::find($request->channel_id);

        // Check if user has access to said channel
        if (!$channel->users->contains('id', $user->id)) {
            abort('403');
        }

        // Create new message
        $message = new Message([
            'message'    => $request->message,
            'channel_id' => $channel->id,
        ]);

        // Save message in user context
        $user->messages()->save($message);

        // Dispatch event
        broadcast(new MessageCreated($message))->toOthers();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Message             $message
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
