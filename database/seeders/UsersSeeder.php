<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Zanuar',
                'email' => 'zanuar@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'aldi',
                'email' => 'aldi@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Syah',
                'email' => 'syah@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Putra',
                'email' => 'putra@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Fikri',
                'email' => 'fikri@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Setiawan',
                'email' => 'setiawan@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Ahmad',
                'email' => 'ahmad@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Agung',
                'email' => 'agung@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Iqbal',
                'email' => 'iqbal@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ],
            [
                'name' => 'Firman',
                'email' => 'firman@gmail.com',
                'password' => Hash::make('123456789'),
                'phone' => '081234567890',
                'photo_url' => '',
            ]
        ];
        DB::table('users')->insert($data);
    }
}
