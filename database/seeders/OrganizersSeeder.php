<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrganizersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' =>  'Andi Kurniawan',
                'email' => 'andi@gmail.com',
                'password' => Hash::make('123456789'),
                'organization' => 'Event Indonesia',
                'phone' => '081234567890'
            ],
            [
                'name' =>  'Awan setiawan',
                'email' => 'awan@gmail.com',
                'password' => Hash::make('123456789'),
                'organization' => 'Malang Event',
                'phone' => '081234567890'
            ],
            [
                'name' =>  'Foni',
                'email' => 'foni@gmail.com',
                'password' => Hash::make('123456789'),
                'organization' => 'Si Paling Event',
                'phone' => '081234567890'
            ],
            [
                'name' =>  'Nanda Okta',
                'email' => 'nanda@gmail.com',
                'password' => Hash::make('123456789'),
                'organization' => 'Pegiat Event',
                'phone' => '081234567890'
            ]
        ];
    }
}
