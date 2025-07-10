<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'event_id' => 1,
                'status' => 'registered',
                'payment_status' => 'pending',
                'qr_code_url' => '',
            ],
            [
                'user_id' => 2,
                'event_id' => 1,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ],
            [
                'user_id' => 3,
                'event_id' => 1,
                'status' => 'cancelled',
                'payment_status' => 'pending',
                'qr_code_url' => '',
            ],
            [
                'user_id' => 3,
                'event_id' => 1,
                'status' => 'cancelled',
                'payment_status' => 'paid',
                'qr_code_url' => '',
            ],
            [
                'user_id' => 4,
                'event_id' => 2,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ],
            [
                'user_id' => 5,
                'event_id' => 3,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ],
            [
                'user_id' => 6,
                'event_id' => 4,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ],
            [
                'user_id' => 7,
                'event_id' => 5,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ],
            [
                'user_id' => 8,
                'event_id' => 5,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ],
            [
                'user_id' => 9,
                'event_id' => 5,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ],
            [
                'user_id' => 10,
                'event_id' => 3,
                'status' => 'registered',
                'payment_status' => 'paid',
                'qr_code_url' => base64_encode(Str::random(32)),
            ]
        ];
        DB::table('tickets')->insert($data);
    }
}
