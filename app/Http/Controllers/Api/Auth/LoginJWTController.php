<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginJWTController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->all(['email', 'password']);

        Validator::make($credentials, [
            'email'=>'required|string',
            'password'=>'required|string'
        ])->validate();

        if(!$token = auth('api')->attempt($credentials)){
            $message = new ApiMessages('Unauthorized');
            return response()->json($message->getMessage(), 401);
        }

        return response()
                ->json([
                    'token'=>$token
                ],200);
    }

    public function logout()
    {
        // Remember to send the token with the request so the auth methods can identify the user and blacklist the token itself
        auth('api')->logout();
        return response()->json([
            'message'=> 'Logout successfully!'
        ],200);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json([
            'token'=>$token
        ]);
    }
}
