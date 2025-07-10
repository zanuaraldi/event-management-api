<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsSeeder::class);
        $this->call(OrganizersSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(SessionsSeeder::class);
        $this->call(TicketsSeeder::class);
    }
}
