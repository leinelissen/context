<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function find($query)
    {
        $users = User::where('first_name', 'LIKE', '%'.$query.'%')
            ->where('id', '!=', Auth::id())
            ->orWhere('last_name', 'LIKE', '%'.$query.'%')
            ->where('id', '!=', Auth::id())
            ->get();

        $users = $users->filter( function ($user, $key) {
            $role = $user->roles()->first();
            return ($role->name === "Teacher" || $role->name === "Student");
        })->values();

        return $users;
    }

    public function show($id)
    {
        return User::with('parent', 'children')->find($id);
    }
}
