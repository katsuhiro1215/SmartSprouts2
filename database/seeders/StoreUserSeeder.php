<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('store_user')->insert([
            [
                'store_id' => 1,
                'user_id' => 1,
            ],
        ]);
    }
}
