<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showRegister()
    {
        // if (Auth::check()) {
        //     return view('/');
        // }

        $user = Auth::guard('web')->user();
        if ($user) {
            return redirect()->route('/');
        }

        return view('registerUser');
    }

    public function showLogin(Request $request)
    {

        // $user = $request->user();
        // $user = Auth::guard('web')->user();
        // if (Auth::check()) {
        //     return view('/');
        // }
        // dd($user);
        // if ($user) {
        //     return redirect()->route('/');
        // }

        return view('loginUser');
    }

    public function registerUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Successful',
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function loginUser(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'message' => 'Successful',
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $request->user()->tokens()->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Successful'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }
    }
}
