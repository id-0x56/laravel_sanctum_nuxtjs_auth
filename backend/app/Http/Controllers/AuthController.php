<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials))
        {
            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken(config('app.name'))->plainTextToken;

            return response()->json([
                'token_type' => 'Bearer',
                'access_token' => $token,
            ], 200);
        }

        return response()->json([], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();

//        $accessToken = $user->currentAccessToken();
//        $accessToken->delete();

        return response()->json([], 204);
    }
}
