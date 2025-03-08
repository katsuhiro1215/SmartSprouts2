<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stores')->insert([
            [
                'organization_id' => 2,
                'name' => 'shuplay体操教室',
                'type' => '本店',
                'code' => 'AM',
                'description' => '兵庫県尼崎市に誕生した体操教室です。',
                'email' => 'info@shuplay.com',
                'store_photo_path' => null,
                'store_logo_path' => null,
                'zipcode' => '6610976',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '潮江',
                'address4' => '1丁目16番1号 アミング潮江ウエスト二番館201-6',
                'phone_number' => '0649506939',
                'fax_number' => null,
                'website' => 'https://shuplay.com/',
                'facebook' => null,
                'twitter' => null,
                'instagram' => 'https://www.instagram.com/shuplay2023/',
                'youtube' => null,
                'line' => 'https://line.me/R/ti/p/@579ifezz',
                'established_date' => '2023-05-01',
                'status' => 1,
            ],
            [
                'organization_id' => 2,
                'name' => 'ヨガ&ピラティス サンテ',
                'type' => '支店',
                'code' => 'AM-yoga',
                'description' => '兵庫県尼崎市に誕生したヨガ教室です。',
                'email' => 'yoga@shuplay.com',
                'store_photo_path' => null,
                'store_logo_path' => null,
                'zipcode' => '6610976',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '潮江',
                'address4' => '1丁目16番1号 アミング潮江ウエスト二番館201-6',
                'phone_number' => '0649506939',
                'fax_number' => null,
                'website' => null,
                'facebook' => null,
                'twitter' => null,
                'instagram' => null,
                'youtube' => null,
                'line' => null,
                'established_date' => '2024-09-01',
                'status' => 1,
            ],
        ]);
    }
}
