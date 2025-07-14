<?php

namespace App\Http\Controllers;

use App\Models\OrganizersModel;
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
}
