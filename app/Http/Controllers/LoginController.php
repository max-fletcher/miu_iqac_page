<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){

        $request->validate([            
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return response()->json(Auth::user(), 201);
        }
        
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect !!'],
            'password' => ['The provided credentials are incorrect !!']
        ]);
    }

    public function logout(){
        Auth::logout();        
    }
}
