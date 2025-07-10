<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use App\Models\EventsModel;
use Laravel\Lumen\Routing\Controller as BaseController;

class EventsController extends BaseController
{
    public function index(){
        return EventsModel::all();
    }

    public function getEvent($id) {
        try {
            $event = EventsModel::with('organizers')->select('event_id', 'organizer_id', 'title', 'description', 'is_private', 'location', 'start_date', 'end_date', 'price')->where('event_id', $id)->first();

            return response()->json($event);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}
