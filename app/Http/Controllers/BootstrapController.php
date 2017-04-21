<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Room;

class BootstrapController extends Controller
{
    /**
     * Return the requested room within the room view
     *
     * @param  int $id The supplied id
     * @return View
     */
    public function getRoom($id)
    {
        $room = Room::findOrFail($id);

        return view('room')->with('room', $room);
    }

    /**
     * Return an overview of all rooms the user is involved with
     *
     * @return View
     */
    public function getRoomOverview()
    {
        $rooms = Auth::user()->rooms->sortByDesc('updated_at');

        return view('index')->with('rooms', $rooms);
    }
}
