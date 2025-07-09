<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'admin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'admin3',
                'email' => 'admin3@gmail.com',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'admin4',
                'email' => 'admin4@gmail.com',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'admin5',
                'email' => 'admin5@gmail.com',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'admin6',
                'email' => 'admin6@gmail.com',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'admin7',
                'email' => 'admin7@gmail.com',
                'password' => Hash::make('123456789'),
            ]
        ];
        DB::table('admins')->insert($data);
    }
}
