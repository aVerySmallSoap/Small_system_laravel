<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    function fetchLog(){
        return view('login');
    }

    function fetchReg(){
        return view('register');
    }

    function login(Request $request){
        $input = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt(['username' => $input['username'], 'password' => $input['password']])){
            Auth::getSession()->regenerate();
            return redirect([], 200);
        }
        return response()->json(['error' => 'error']);
    }

    function register(Request $request){
        User::create([
            'username' => $request['username'],
            'password' => Hash::make($request['password'])
        ]);
        return response([], 200);
    }
}
