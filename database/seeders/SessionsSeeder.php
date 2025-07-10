<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'event_id' => 1,
                'title' => 'Webinar public speaking',
                'speaker' => 'Irwandi',
                'start_time' => '2025-07-10 12:30:00',
                'end_time' => '2025-07-10 17:30:00'
            ],
            [
                'event_id' => 2,
                'title' => 'Webinar penggunaan AI dalam bisnis',
                'speaker' => 'Ferry',
                'start_time' => '2025-08-07 08:00:00',
                'end_time' => '2025-08-07 15:00:00'
            ],
            [
                'event_id' => 3,
                'title' => 'Pelatihan Linux dasar',
                'speaker' => 'Afrizal',
                'start_time' => '2025-07-25 09:00:00',
                'end_time' => '2025-07-25 13:00:00'
            ],
            [
                'event_id' => 4,
                'title' => 'Kelas dasar flutter',
                'speaker' => 'Eko Kurniawan Khannedy',
                'start_time' => '2025-10-18 07:30:00',
                'end_time' => '2025-10-18 11:00:00'
            ],
            [
                'event_id' => 5,
                'title' => 'Typerscript Dasar',
                'speaker' => 'Eko Kurniawan Khannedy',
                'start_time' => '2025-08-10 08:00:00',
                'end_time' => '2025-08-10 15:00:00'
            ],
            [
                'event_id' => 5,
                'title' => 'Typerscript Object Oriented Programming (OOP)',
                'speaker' => 'Eko Kurniawan Khannedy',
                'start_time' => '2025-08-11 08:00:00',
                'end_time' => '2025-08-11 15:00:00'
            ],
            [
                'event_id' => 5,
                'title' => 'Typerscript Generic',
                'speaker' => 'Eko Kurniawan Khannedy',
                'start_time' => '2025-08-12 08:00:00',
                'end_time' => '2025-08-12 15:00:00'
            ],
            [
                'event_id' => 5,
                'title' => 'Typerscript Validation',
                'speaker' => 'Eko Kurniawan Khannedy',
                'start_time' => '2025-08-13 08:00:00',
                'end_time' => '2025-08-13 15:00:00'
            ],
            [
                'event_id' => 5,
                'title' => 'Typerscript Restful API',
                'speaker' => 'Eko Kurniawan Khannedy',
                'start_time' => '2025-08-14 08:00:00',
                'end_time' => '2025-08-14 15:00:00'
            ]
        ];
        DB::table('sessions')->insert($data);
    }
}
