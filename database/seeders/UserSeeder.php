<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run ()
    {
        DB::table ('users')->insert ([
            'name' => 'Admin',
            'email' => 'admin@mail.test',
            'email_verified_at' => now (),
            'password' => '$2y$10$dagajK1X6sfvLwRVV2P1lO05sGi7V071I2tCvhOISwMX/TcHsUN6m', // password
        ]);
    }
}
