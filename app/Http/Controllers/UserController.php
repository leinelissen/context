<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function find($query)
    {
        return User::where('first_name', 'LIKE', '%' . $query . '%')
            ->orWhere('last_name', 'LIKE', '%' . $query . '%')
            ->get();
    }
}
