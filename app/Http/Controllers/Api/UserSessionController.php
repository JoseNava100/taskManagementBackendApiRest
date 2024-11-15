<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserSessionController extends Controller
{
    public function login(Request $request){
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credential)) {
            
            $user = Auth::user();
            $token = $user->createToken('Token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);

            $message = [
                'message' => 'Correct access',
                'token' => $token,
                'status' => 200
            ];

            return response($message, 200)->withCookie($cookie);

        } else {

            $message = [
                'message' => 'The credentials are not valid',
                'status' => 401
            ];

            return response($message, 401);
        }
    }

    public function logout(Request $request) {
        
        if (Auth::check()) {
            $user = Auth::user();
    
            
            $user->tokens->each(function ($token) {
                $token->delete();
            });
    
            
            Auth::logout();
    
            
            $cookie = Cookie::forget('cookie_token'); 
    
            $message = [
                'message' => 'Logged out successfully',
                'status' => 200
            ];
    
            return response()->json($message, 200)->withCookie($cookie);
        }
    
        return response()->json([
            'message' => 'Unauthorized',
            'status' => 401
        ], 401);
    }

    public function profile() {

        if (!Auth::check()) {

            $message = [
                'message' => 'Unauthorized',
                'status' => 401
            ];

            return response()->json($message, 401);

        } else {
            
            $user = Auth::user();

            $message = [
                'message' => 'User profile fetched successfully',
                'userData' => $user,
                'status' => 200
            ];

            return response()->json($message, 200);

        }
    }
}
