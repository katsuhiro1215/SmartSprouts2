<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('system_settings')->insert([
            [
                'name' => 'SmartSproutsSystem',
                'description' => '大規模顧客管理システムです。水泳教室や体操教室など習い事の他、幼稚園、塾などでも使用することができます。',
                'version' => '1.0.0',
                'frontend' => 'HTML, CSS(Bootstrap), JavaScript(jQuery)',
                'backend' => 'PHP8.02, Laravel9.19',
                'system_photo_path' => null,
                'system_logo_path' => null,
                'website' => 'https://smartsprouts.jp',
                'facebook' => null,
                'twitter' => null,
                'instagram' => null,
                'youtube' => null,
                'line' => null,
                'opening_date' => '2023-06-13',
            ],
        ]);
    }
}
