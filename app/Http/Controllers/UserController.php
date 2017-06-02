<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function find($query)
    {
        return User::where('first_name', 'LIKE', '%'.$query.'%')
            ->where('id', '!=', Auth::id())
            ->orWhere('last_name', 'LIKE', '%'.$query.'%')
            ->where('id', '!=', Auth::id())
            ->get();
    }
}
