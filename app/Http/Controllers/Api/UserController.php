<?php

namespace ListIt\Http\Controllers\Api;

use ListIt\Http\Controller;

class UserController extends Controller {
    public function create(Request $request) {
        $this->validate($request, [
            'user' => 'required|unique:user,Name',
            'email' => 'required|email|unique:user,Email',
            'password' => 'required'
        ]);

        $user = new \ListIt\User();
        $user->Name = $request->input('user');
        $user->Email = $request->input('email');
        $user->Password = Hash::make($request->input('password'));

        $user->save();
    }
    public function get() {        
        return \ListIt\User::all();    
    }
}
