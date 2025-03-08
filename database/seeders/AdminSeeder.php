<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'username' => 'katsuhiro',
                'email' => 'katsuhiro.k1215@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('katsu1215SHR'),
                'role' => 'Owner',
                'remember_token' => null,
            ],
            [
                'username' => 'nakamura',
                'email' => 'nakamura@kenkosya.com',
                'email_verified_at' => null,
                'password' => Hash::make('nakamura123kenkosya'),
                'role' => 'SuperAdmin',
                'remember_token' => null,
            ],
            [
                'username' => 'kondo',
                'email' => 'kondo@kenkosya.com',
                'email_verified_at' => null,
                'password' => Hash::make('kondo123kenkosya'),
                'role' => 'Admin',
                'remember_token' => null,
            ],
            [
                'username' => 'keiri',
                'email' => 'keiri@kenkosya.com',
                'email_verified_at' => null,
                'password' => Hash::make('keiri123kenkosya'),
                'role' => 'SubAdmin',
                'remember_token' => null,
            ],
            [
                'username' => 'nakamura',
                'email' => 'nakamura@shuplay.com',
                'email_verified_at' => null,
                'password' => Hash::make('nakamura123shuplay'),
                'role' => 'Manager',
                'remember_token' => null,
            ],
            [
                'username' => 'aiga',
                'email' => 'aiga@shuplay.com',
                'email_verified_at' => null,
                'password' => Hash::make('aiga123shuplay'),
                'role' => 'Employee',
                'remember_token' => null,
            ],
        ]);
    }
}
