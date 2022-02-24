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
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // if (Auth::attempt($credentials)) {
        //     $user   = auth()->user();
        //     $token  = $request->user()->createToken('login-user');
        //     return response()->json([
        //         'data'  => $user,
        //         'token' => $token
        //     ], 200);
        // }

        // $data['status'] = 401;
        // $data['message'] = 'Unauthorized';

        
        // return response()->json($data, 401);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
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

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
