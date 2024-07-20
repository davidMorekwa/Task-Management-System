<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIAuthController extends Controller
{
    public function login(LoginRequest $request){
        // return $request;
        $response = Auth::attempt($request->only('email', 'password'));
        if(!$response){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
        $user = Auth::user();

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }
    public function logout(Request $request){
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        Auth::guard('web')->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function getToken(){
        $user = Auth::user();
        if($user != null){
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message'=>"You ar not authenticated. Please Login or register"
            ]);
        }
    }
}
