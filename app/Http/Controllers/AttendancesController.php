<?php

namespace App\Http\Controllers;

use App\Models\AttendancesModel;
use Laravel\Lumen\Routing\Controller as BaseController;

class AttendancesController extends BaseController
{
    public function getAttendanceEvent($id){
        try {
            $attendance = AttendancesModel::with('users', 'events')->select('attendance_id', 'user_id', 'event_id', 'checked_in_at')->where('event_id', $id);
            
            return response()->json($attendance);
        } catch (\Throwable $th) {
            return response()->json([
                'massage' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}
