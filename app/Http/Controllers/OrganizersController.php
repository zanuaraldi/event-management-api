<?php

namespace App\Http\Controllers;

use App\Models\OrganizersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class OrganizersController extends BaseController
{
    public function index()
    {
        return OrganizersModel::all();
    }

    public function destroyOrganizer($id)
    {
        try {
            $organizer = OrganizersModel::findOrFail($id);

            if (!$organizer) {
                return response()->json([
                    'success' => false,
                    'massage' => 'Data tidak ditemukan'
                ], 400);
            }

            $organizer->delete();
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

    public function storeOrganizer(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|string|max:150|unique:organizers,email',
                'password' => 'required|string|max:255',
                'organization' => 'required|string|max:150',
                'phone' => 'required|digits_between:11,20',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'error' => $validator->errors()
                ], 400);
            }

            $organizer = OrganizersModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'organization' => $request->organization,
                'phone' => $request->phone,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Organizer baru berhasil dibuat',
                'data' => $organizer
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}
