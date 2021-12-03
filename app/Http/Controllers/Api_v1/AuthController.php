<?php

namespace App\Http\Controllers\Api_v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user   = auth()->user();
            $token  = $request->user()->createToken('login-client');
            return response()->json([
                'data'  => $user,
                'token' => $token
            ], 200);
        }

        $data['status'] = 401;
        $data['message'] = 'Unauthorized';

        return response()->json($data, 401);
    }
}
