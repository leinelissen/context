<?php

namespace App\Http\Controllers;

use App\Channel;
use App\User;
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
        return Auth::user()->channels->load(['users' => function ($query) {
            $query->where('users.id', '!=', Auth::id());
        }]);
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
            'user'  => 'required_if:group,0|integer',
            'users' => 'required_if:group,1|array'
        ]);

        // Fetch current user
        $user = Auth::user();

        // Fetch target users
        if ($request->group) {
            $target = User::findorFail($request->users);
        } else {
            $target = User::findOrFail($request->user);
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
        return $channel->load(['messages.user', 'users' => function ($query) {
            $query->where('users.id', '!=', Auth::id());
        }]);
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
}
