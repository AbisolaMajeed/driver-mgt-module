<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('API Token')->plainTextToken;
            return successResponse("User logged in successfully", [
                'token' => $token,
                'user' => $user
            ]);
        }

        return errorResponse("Action failed");        
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete(); // Revoke all tokens
        return successResponse("Logged out successfully");
    }
}
