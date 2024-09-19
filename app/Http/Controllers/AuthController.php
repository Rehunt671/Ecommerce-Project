<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->accessToken;
            return response()->json(['token' => $token], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function register(Request $request) {
        Log::info('Register method hit');
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        $token = $user->createToken('authToken')->accessToken;
        return response()->json(['token' => $token], 200);
    }
    
}
