<?php

namespace App\Http\Controllers;

use App\Models\TicketsModel;
use Laravel\Lumen\Routing\Controller as BaseController;

class TicketsController extends BaseController
{
    public function getTicketQR($id){
        try {
            $ticket = TicketsModel::findOrFail($id);
            
            if($ticket->user_id != auth('users')->user()->user_id){
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
}
