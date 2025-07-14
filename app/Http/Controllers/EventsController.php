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
            
            $event = EventsModel::create([
                'organizer_id' => auth()->user()->organizer_id,
                'title' => $request->title,
                'description' => $request->description,
                'is_private' => $request->is_private,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'price' => $request->price
            ]);
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

    public function updateEvent(Request $request, $id)
    {
        try {
            $event = EventsModel::findOrFail($id);
            if (!$event) {
                return response()->json([
                    'success' => false,
                    'massage' => 'Data event tidak ada'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
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

            $event->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_private' => $request->is_private,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'price' => $request->price
            ]);
            return response()->json([
                'success' => true,
                'massage' => 'Data berhasil di update',
                'data' => $event
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan ketika menambah data'
            ], 500);
        }
    }

    public function destoryEvent($id){
        try {
            $event = EventsModel::findOrFail($id);

            if(!$event){
                return response()->json([
                    'success' => false,
                    'massage' => 'Data tidak ditemukan'
                ], 400);
            }

            $event->delete();
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
