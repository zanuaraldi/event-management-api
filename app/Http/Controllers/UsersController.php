<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
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
}
