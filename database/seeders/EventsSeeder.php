<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'organizer_id' => 1,
                'title' => 'Webinar public speaking',
                'description' => 'Webinar tentang bagaimana public speaking yang baik',
                'is_private' => 0,
                'location' => 'Jl. Suhat',
                'start_date' => '2025-07-10 12:30:00',
                'end_date' => '2025-07-10 17:30:00',
                'price' => '50000'
            ],
            [
                'organizer_id' => 2,
                'title' => 'Webinar penggunaan AI dalam bisnis',
                'description' => 'Webinar tentang bagaimana pemanfaatan AI untuk kelangsungan bisnis',
                'is_private' => 0,
                'location' => 'Jl. Dinoyo',
                'start_date' => '2025-08-07 08:00:00',
                'end_date' => '2025-08-07 15:00:00',
                'price' => '75000'
            ],
            [
                'organizer_id' => 3,
                'title' => 'Pelatihan Linux dasar',
                'description' => 'Pelatihan tentang penggunaan linux di kelas basic',
                'is_private' => 0,
                'location' => 'Jl. Jakarta',
                'start_date' => '2025-07-25 09:00:00',
                'end_date' => '2025-07-25 13:00:00',
                'price' => '150000'
            ],
            [
                'organizer_id' => 4,
                'title' => 'Kelas dasar flutter',
                'description' => 'Kelas belajar flutter di tingkat dasar',
                'is_private' => 0,
                'location' => 'Jl. Suhat',
                'start_date' => '2025-10-18 07:30:00',
                'end_date' => '2025-10-18 11:00:00',
                'price' => '80000'
            ],
            [
                'organizer_id' => 1,
                'title' => 'Kelas belajar typescript',
                'description' => 'Kelas belajar typescript dari dasar sampai bikin website',
                'is_private' => 0,
                'location' => 'Jl. Suhat',
                'start_date' => '2025-08-10 08:00:00',
                'end_date' => '2025-10-14 15:00:00',
                'price' => '70000'
            ]
        ];
        DB::table('events')->insert($data);
    }
}
