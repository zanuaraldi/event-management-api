<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\SessionsModel;

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
}
