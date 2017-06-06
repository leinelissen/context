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

        $users->filter( function (User $user) {
            $role = $user->roles()->first();
            return $role->name === "Teacher" || $role->name === "Student";
        });

        return $users;
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }
}
