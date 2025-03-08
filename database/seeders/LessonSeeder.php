<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lessons')->insert([
            [
                'store_id' => 1,
                'name' => '体操教室',
                'description' => '会員制の体操教室です。',
                'lesson_photo_path' => null,
                'status' => true,
            ],
            [
                'store_id' => 1,
                'name' => 'ヨガ・ピラティス教室',
                'description' => '会員制の体操教室です。',
                'lesson_photo_path' => null,
                'status' => false,
            ],
        ]);
    }
}
