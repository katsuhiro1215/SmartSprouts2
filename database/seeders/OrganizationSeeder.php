<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('organizations')->insert([
            [
                'type' => '個人',
                'name' => 'かつコード',
                'description' => '奈良県にある小さなWeb制作会社です。',
                'email' => 'info@katsucode.jp',
                'organization_photo_path' => null,
                'organization_logo_path' => null,
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
            [
                'type' => '法人',
                'name' => '株式会社 ケンコー社',
                'description' => '登山・キャンプ、アウトドア用品輸入・卸販売、こども向け体操教室事業。',
                'email' => 'info@kenkosya.com',
                'organization_photo_path' => null,
                'organization_logo_path' => null,
                'zipcode' => '5310072',
                'address1' => '大阪府',
                'address2' => '大阪市北区',
                'address3' => '豊崎',
                'address4' => '1-3-11',
                'phone_number' => '0663742788',
                'fax_number' => '0663742256',
                'website' => 'https://kenkosya.com/',
                'facebook' => 'https://www.facebook.com/kenkosya',
                'twitter' => 'https://twitter.com/kenkosya_japan',
                'instagram' => 'https://www.instagram.com/kenkosya/',
                'youtube' => 'https://www.youtube.com/channel/UCC96IvcP8uf9THOwwc1Pp5Q',
                'line' => null,
                'established_date' => '1979-8-1',
            ],
        ]);
    }
}
