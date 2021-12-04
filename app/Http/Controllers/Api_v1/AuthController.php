<?php

namespace App\Http\Controllers\Api_v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|unique:users,email',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            $data = array(
                'status' => 422,
                'error' => 1,
                'message' =>  $validator->errors()
            );
            return response()->json($data, 422);
        }

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'remember_token'    => Str::random(10),

        ]);

        $data = array(
            'status' => 201,
            'error'  => 0,
            'message' => 'User Created'
        );

        return response()->json($data, 201);
    }
}
