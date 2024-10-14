<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if (!$user->is_admin) {
                    return response()->json(['message' => 'Unauthorized. Only administrators can log in.'], 401);
                }

                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Login successful.',
                    'access_token' => $token
                ], 200);
            }

            return response()->json(['message' => 'Invalid credentials. Please check your email and password.', 'status_code' => 401], 401);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'An error occurred during login. Please try again later.',
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json([
                'message' => 'Successfully logged out.',
            ], 200);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'An error occurred during logout. Please try again later.',
            ], 500);
        }
    }
}
