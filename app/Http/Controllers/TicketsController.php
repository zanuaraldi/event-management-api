<?php

namespace App\Http\Controllers;

use App\Models\AttendancesModel;
use App\Models\TicketsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Laravel\Lumen\Routing\Controller as BaseController;

class TicketsController extends BaseController
{

    public function index()
    {
        try {
            $tickets = TicketsModel::select('ticket_id', 'user_id', 'event_id', 'status', 'payment_status', 'qr_code_url')->where('user_id', auth('users')->user()->user_id);

            return response()->json($tickets);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function getTicket($id)
    {
        try {
            $ticket = TicketsModel::with('events')->find($id);

            if (!$ticket) {
                return response()->json([
                    'success' => false,
                    'massage' => 'Ticket tidak ada'
                ], 404);
            }

            if ($ticket->user_id != auth('users')->user()->user_id) {
                return response()->json([
                    'success' => false,
                    'massage' => 'Tidak ada izin untuk tiket ini'
                ], 401);
            }

            return response()->json($ticket);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function getTicketQR($id)
    {
        try {
            $ticket = TicketsModel::findOrFail($id);

            if ($ticket->user_id != auth('users')->user()->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak punya izin ke tiket ini'
                ], 401);
            }

            return response()->json($ticket);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function cancelTicket($id)
    {
        try {
            $ticket = TicketsModel::find($id);

            if ($ticket->user_id != auth('users')->user()->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak punya izin ke tiket ini'
                ], 401);
            }

            if ($ticket->user_id != auth('users')->user()->user_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak punya izin ke tiket ini'
                ], 401);
            }

            $ticket->update([
                'status' => 'cancelled'
            ]);

            return response()->json([
                'success' => true,
                'massage' => 'Cancel tiket berhasil',
                'data' => $ticket
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function checkIn(Request $request)
    {
        try {
            $qr = $request->only(['qr_code']);

            $validator = Validator::make($qr, [
                'qr_code' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'error' => $validator->errors()
                ], 400);
            }

            $checkTicket = TicketsModel::select('ticket_id', 'user_id', 'event_id', 'status', 'payment_status', 'qr_code_url')->where('qr_code_url', $qr);

            if (!$checkTicket) {
                return response()->json([
                    'success' => false,
                    'massage' => 'Ticket tidak ada'
                ], 404);
            }

            // // agak rancu
            // if ($checkTicket->user_id != auth('users')->user()->user_id) {
            //     return response()->json([
            //         'success' => false,
            //         'massage' => 'Anda tidak punya izin dengan ticket ini'
            //     ], 401);
            // }

            if ($checkTicket->status == 'cancelled' || $checkTicket->payment_status == 'pending') {
                return response()->json([
                    'success' => false,
                    'massage' => 'Tiket tidak bisa digunakan'
                ], 400);
            }

            $attendance = AttendancesModel::create([
                'user_id' => $checkTicket->user_id,
                'event_id' => $checkTicket->event_id,
                'checked_in_at' => Carbon::now()
            ]);

            return response()->json([
                'success' => true,
                'massage' => 'Check in berhasil dilakukan',
                'data' => $attendance
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    public function registerTicket($id)
    {
        try {
            $ticket = TicketsModel::create([
                'user_id' => auth('user')->user()->user_id,
                'event_id' => $id,
                'status' => 'registered',
                'payment_status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'massage' => 'Registrasi tiket berhasil di lakukan',
                'data' => $ticket
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}
