<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'admin_id' => 1,
                'name' => 'かつコード',
                'description' => '奈良県にある小さなWeb制作会社です。',
                'company_photo_path' => null,
                'company_logo_path' => null,
                'zipcode' => '6308303',
                'address1' => '奈良県',
                'address2' => '奈良市',
                'address3' => '南紀寺町',
                'address4' => '2丁目274-3萠黄アパート103号',
                'phone_number' => '090-9580-9257',
                'fax_number' => null,
                'email' => 'info@katsucode.jp',
                'website' => 'https://katsucode.jp',
                'facebook' => 'https://www.facebook.com/katsucode20220513',
                'twitter' => null,
                'instagram' => 'https://www.instagram.com/katsucode/',
                'youtube' => null,
                'line' => null,
                'established_date' => '2022-05-13',
            ],
        ]);
    }
}
