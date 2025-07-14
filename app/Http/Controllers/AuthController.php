<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    // public function __construct()
    // {
    //     $this->middleware('auth:users', ['only' => ['loginUser', 'logout']]);
    //     $this->middleware('auth:admins', ['only' => ['loginAdmin', 'logout']]);
    //     $this->middleware('auth:organizers', ['only' => ['loginAdmin', 'logout']]);
    // }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|string|max:150',
                'password' => 'required|string',
                'phone' => 'required|numeric|digits:20',
                'photo_url' => 'string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'error' => $validator->errors()
                ], 400);
            }

            $register = UsersModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'photo_url' => $request->photo_url
            ]);

            if ($register) {
                return response()->json([
                    'success' => true,
                    'message' => 'Register berhasil dilakukan',
                    'data' => $register
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Register gagal dilakukan',
                    'data' => ''
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $th
            ], 500);
        }
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('users')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function loginOrganizer(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('organizers')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('admins')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
