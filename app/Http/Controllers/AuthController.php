<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function login(LoginRequest $request) {
        $validated = $request->validated();

        $user = User::where("email", $validated["email"])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false, 
                'message' => 'Invalid credentials'
                ],401);
        }
        
        $token = $user->createToken('authToken');

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }

    public function logout(Request $request) {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logged out'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'No authenticated user'
        ], 401);
    }
}
