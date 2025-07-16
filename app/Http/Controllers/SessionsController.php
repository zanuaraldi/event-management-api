<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\SessionsModel;
use App\Models\EventsModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SessionsController extends BaseController
{
    public function index($id)
    {
        try {
            $session = SessionsModel::with('events')->select('session_id', 'event_id', 'title', 'speaker', 'start_time', 'end_time')->where('event_id', $id)->get();

            return response()->json($session);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function storeSession(Request $request, $id)
    {
        try {
            $event = EventsModel::find($id);

            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ada'
                ], 400);
            }

            if ($event->organizer_id != auth('organizers')->user()->organizer_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak punya izin untuk menambah sesi di event ini'
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:150',
                'speaker' => 'required|string|max:100',
                'start_time' => 'required|date',
                'end_time' => 'required|date',
            ]);

            $validator->after(function ($validator) use ($request, $event) {
                $startTime = Carbon::parse($request->start_time);
                $endTime   = Carbon::parse($request->end_time);

                if ($startTime < $event->start_date || $endTime > $event->end_date) {
                    $validator->errors()->add('start_time', 'Waktu session harus berada di antara waktu event.');
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'error' => $validator->errors()
                ], 400);
            }

            $session = SessionsModel::create([
                'event_id' => $id,
                'title' => $request->title,
                'speaker' => $request->speaker,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $session
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function updateSession(Request $request, $id)
    {
        try {
            $session = SessionsModel::find($id);
            if (!$session) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ada'
                ], 400);
            }

            $event = EventsModel::select('event_id', 'organizer_id', 'start_date', 'end_date')->where('event_id', $session->event_id)->first();

            if ($event->organizer_id != auth('organizers')->user()->organizer_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak punya izin untuk update sesi ini'
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:150',
                'speaker' => 'required|string|max:100',
                'start_time' => 'required|date',
                'end_time' => 'required|date',
            ]);

            $validator->after(function ($validator) use ($request, $event) {
                $startTime = Carbon::parse($request->start_time);
                $endTime   = Carbon::parse($request->end_time);

                if ($startTime < $event->start_date || $endTime > $event->end_date) {
                    $validator->errors()->add('start_time', 'Waktu session harus berada di antara waktu event.');
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'error' => $validator->errors()
                ], 400);
            }

            $session->update([
                'title' => $request->title,
                'speaker' => $request->speaker,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil di update',
                'data' => $session
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}
