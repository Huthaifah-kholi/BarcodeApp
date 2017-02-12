<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;

use App\Http\Requests;

use App\User;

class RegistrationController extends Controller
{
     public function registar(Request $request)
    {
        $newUser= new User();
        $newUser->name= $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->role = $request->input('role');
        $newUser->save();

        return "signup success";
    }
}
