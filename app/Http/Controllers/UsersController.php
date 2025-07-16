<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        return UsersModel::all();
    }

    public function destroyUser($id)
    {
        try {
            $user = UsersModel::findOrFail($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'massage' => 'Data tidak ditemukan'
                ], 400);
            }

            $user->delete();
            return response()->json([
                'success' => true,
                'massage' => 'Data berhasil dihapus'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function storeUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|string|max:150|unique:users,email',
                'password' => 'required|string|max:255',
                'phone' => 'required|digits_between:11,20',
                'photo_url' => 'string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'error' => $validator->errors()
                ], 400);
            }

            $user = UsersModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'photo_url' => $request->photo_url
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User baru berhasil di buat',
                'data' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}
