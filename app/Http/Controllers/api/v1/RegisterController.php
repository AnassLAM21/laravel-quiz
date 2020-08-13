<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data =  $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|min:6'
        ]);
        
        

        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => bcrypt($request->password)
        ]);

        if(!Auth::attempt($data)){
            return response(['message' => 'Invalid login credentials.']);
        }
        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user' => Auth::user() ,'access_token' => $accessToken]);
    }

}
