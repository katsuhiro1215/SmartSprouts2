<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'katsuhiro',
                'email' => 'katsuhiro.k1215@katsucode.jp',
                'email_verified_at' => null,
                'password' => bcrypt('password'),
                'is_withdrawn' => false,
                'registration_token' => null,
                'google_id' => null,
                'provider' => null,
                'login_at' => null,
                'logout_at' => null,
            ],
        ]);
    }
}
