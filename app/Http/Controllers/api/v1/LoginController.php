<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LoginController extends Controller
{
    
    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            

            $user = Auth::user();
            $objToken = $user->createToken('API Access');
            $strToken = $objToken->accessToken;

            $expiration = $objToken->token->expires_at->diffInSeconds(Carbon::now());

            return response()->json(["token_type" => "Bearer", "expires_in" => $expiration, "access_token" => $strToken]);
        }

        return response()->json(["error" => "invalid_credentials", "message" => "The user credentials were incorrect."], 401);

        
        // $login = $request->validate([
        //     'email' => 'required|email', 
        //     'password' => 'required'
        // ]);
        
        
        // if(!Auth::attempt($login)){
        //     return response(['message' => 'Invalid login credentials.']);
        // }

        // $accessToken = Auth::user()->createToken('authToken')->accessToken;
        // $accessToken = Auth::user()->createToken('authToken')->accessToken;
        // return response(['user' => Auth::user() ,'access_token' => $accessToken]);
    }
}
