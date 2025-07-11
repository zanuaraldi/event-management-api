<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use App\Models\EventsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class EventsController extends BaseController
{
    public function index()
    {
        return EventsModel::all();
    }

    public function getEvent($id)
    {
        try {
            $event = EventsModel::with('organizers')->select('event_id', 'organizer_id', 'title', 'description', 'is_private', 'location', 'start_date', 'end_date', 'price')->where('event_id', $id)->first();

            return response()->json($event);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function storeEvent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'organizer_id' => 'required|exists:organizers,organizer_id',
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'is_private' => 'required|min:0|max:1',
                'location' => 'required|string||max:150',
                'start_date' => 'required',
                'end_date' => 'required',
                'price' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'error' => $validator->errors()
                ], 400);
            }
            // nanti ganti perfield karena organizer_id dari auth()
            $event = EventsModel::create($validator->validate());
            return response()->json([
                'success' => true,
                'message' => 'Tambah data berhasil dilakukan',
                'data' => $event
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika menambah data',
                'error' => $th
            ], 500);
        }
    }
}
