<?php

namespace App\Http\Controllers;

use App\Channel;
use App\User;
use App\ReadReceipt;
use App\Events\NewAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Auth::user()->channels()->orderBy('updated_at', 'desc')->get();

        $channels->each(function ($channel) {
            // Add user to non-group channels
            if (!$channel->group) {
                $channel->user = $channel->users()->where('channel_user.user_id', '!=', Auth::id())->first();
            }

            // Add amount of read receipts
            $channel->read_receipts = $channel->readReceipts()
                ->where('read_receipts.user_id', Auth::id())
                ->where('read', false)
                ->count();
        });
        return $channels;
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
            'group' => 'required|boolean',
            'name'  => 'nullable|string',
            'user'  => 'required_if:group,0|integer|not_in:'.Auth::id(),
            'users' => 'required_if:group,1|array',
        ]);

        // Fetch current user
        $user = Auth::user()->load(['channels', 'channels.users' => function ($query) {
            $query->where('users.id', '!=', Auth::id());
        }]);

        // Fetch target users
        if ($request->group) {
            $target = User::findorFail($request->users);
        } else {
            $target = User::findOrFail($request->user);

            // Check if a conversation already exists
            $check = $user->channels->filter(function ($channel, $key) use ($target) {
                return $channel->users->contains($target) && !$channel->group;
            });

            if ($check->count() > 0) {
                $channel = $check->first();
                $channel->error = 'exists';

                return $channel;
            }
        }

        // Create new message
        $channel = new Channel([
            'group' => $request->group,
            'name'  => $request->name,
        ]);

        // Assign new message to current user
        $user->channels()->save($channel);
        $channel->users()->attach($target);

        return $channel->load(['users' => function ($query) {
            $query->where('users.id', '!=', Auth::id());
        }]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Room $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        $channel = $channel->load(['messages', 'messages.user', 'messages.readReceipts' => function ($query) {
            $query->where('user_id', Auth::id());
            $query->where('read', false);
        }]);

        if (!$channel->group) {
            $channel->user = $channel->users()->where('channel_user.user_id', '!=', Auth::id())->first();
        }

        $channel->messages->transform( function ($message) {
            $message->read = !boolval(count($message->readReceipts));
            unset($message->readReceipts);
            return $message;
        });

        return $channel;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Room $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Room                $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Room $channel
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //
    }

    public function announce(Request $request, $id)
    {
        $channel = Channel::findOrFail($id);

        if (!$channel->users->contains('id', Auth::id()) || !Auth::user()->roles->contains('name', 'Teacher')) {
            abort('403');
        }

        $this->validate($request, [
            'announcement' => 'required|string'
        ]);

        $channel->announcement = $request->announcement;
        $channel->save();

        // Dispatch event
        broadcast(new NewAnnouncement($this->show($channel)));

        return "true";
    }
}
