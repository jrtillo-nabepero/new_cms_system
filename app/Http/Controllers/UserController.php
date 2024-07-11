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

    public function update(User $user){

        $inputs = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['min:6', 'max:255', 'confirmed']
        ]);

        if(request('avatar')){
            $inputs['path'] = request('avatar')->store('images');
        }

        // dd($inputs);
        $user->update($inputs);

        return back();
    }
}
