<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //

    public function show(User $user){

        return view('admin.users.profile', ['user' => $user]);
    }
}
