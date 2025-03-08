<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('schools')->insert([
            [
                'type' => '小学校',
                'name' => '尼崎市立明城小学校',
                'zipcode' => '660-0825',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '南城内',
                'address4' => '10-1',
                'phone_number' => '06-6481-2432'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立難波小学校',
                'zipcode' => '660-0892',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '東難波町',
                'address4' => '4丁目3-40',
                'phone_number' => ' 06-6481-2502'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立難波の梅小学校',
                'zipcode' => '660-0893',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '西難波町',
                'address4' => '6丁目14-5',
                'phone_number' => '06-6482-2581'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立竹谷小学校',
                'zipcode' => '660-0878',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '北竹谷町',
                'address4' => '2丁目36',
                'phone_number' => '06-6411-3381'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立下坂部小学校',
                'zipcode' => '661-0975',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '下坂部',
                'address4' => '1丁目12-1',
                'phone_number' => '06-6499-1206'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立潮小学校',
                'zipcode' => '661-0976',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '潮江',
                'address4' => '2丁目2-20',
                'phone_number' => '06-6499-7169'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立長州小学校',
                'zipcode' => '660-0801',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '長洲東通',
                'address4' => '3丁目7-1',
                'phone_number' => '06-6488-0490'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立清和小学校',
                'zipcode' => '660-0803',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '長洲本通',
                'address4' => '1丁目8-1',
                'phone_number' => '06-6488-4381'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立杭瀬小学校',
                'zipcode' => '660-0815',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '杭瀬北新町',
                'address4' => '2丁目6-1',
                'phone_number' => '06-6488-3581'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立浦風小学校',
                'zipcode' => '660-0822',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '杭瀬南新町',
                'address4' => '4丁目1-34',
                'phone_number' => '06-6488-0328'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立金楽寺小学校',
                'zipcode' => '660-0806',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '金楽寺町',
                'address4' => '2丁目3-1',
                'phone_number' => '06-6482-0276'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立浜小学校',
                'zipcode' => '661-0967',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '浜',
                'address4' => '2丁目21-1',
                'phone_number' => '06-6499-1536'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立大庄小学校',
                'zipcode' => '660-0075',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '大庄中通',
                'address4' => '4丁目43-1',
                'phone_number' => '06-6417-3621'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立成丈小学校',
                'zipcode' => '660-0081',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '蓬川町',
                'address4' => '302-2',
                'phone_number' => '06-6413-1601'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立成徳小学校',
                'zipcode' => '660-0081',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '蓬川町',
                'address4' => '302-2',
                'phone_number' => '06-6413-1601'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立わかば西小学校',
                'zipcode' => '660-0084',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '武庫川町',
                'address4' => '1丁目25',
                'phone_number' => '06-6418-2888'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立大島小学校',
                'zipcode' => '660-0064',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '稲葉荘',
                'address4' => '2丁目10-7',
                'phone_number' => '06-6417-5721'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立浜田小学校',
                'zipcode' => '660-0062',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '浜田町',
                'address4' => '3丁目110',
                'phone_number' => '06-6417-8331'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立立花小学校',
                'zipcode' => '661-0013',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '栗山町',
                'address4' => '2丁目26-1',
                'phone_number' => '06-6429-6554'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立立花南小学校',
                'zipcode' => '661-0024',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '三反田町',
                'address4' => '2丁目16-1',
                'phone_number' => '06-6427-5445'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立立花西小学校',
                'zipcode' => '661-0033',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '南武庫之荘',
                'address4' => '3丁目14-9',
                'phone_number' => '06-6437-3820'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立立花北小学校',
                'zipcode' => '661-0013',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '栗山町',
                'address4' => '2丁目6-1',
                'phone_number' => '06-6427-4029'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立名和小学校',
                'zipcode' => '661-0021',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '名神町',
                'address4' => '3丁目1-51',
                'phone_number' => '06-6428-0114'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立塚口小学校',
                'zipcode' => '661-0002',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '塚口町',
                'address4' => '4丁目38-1',
                'phone_number' => '06-6421-5519'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立尼崎北小学校',
                'zipcode' => '661-0002',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '塚口町',
                'address4' => '6丁目21-1',
                'phone_number' => '06-6422-4525'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立水堂小学校',
                'zipcode' => '661-0026',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '水堂町',
                'address4' => '1丁目32-8',
                'phone_number' => '06-6437-3804'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立七松小学校',
                'zipcode' => '660-0053',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '七松町',
                'address4' => '1丁目4-49',
                'phone_number' => '06-6417-7741'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立武庫小学校',
                'zipcode' => '661-0043',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '武庫元町',
                'address4' => '2丁目25-34',
                'phone_number' => '06-6431-5239'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立武庫南小学校',
                'zipcode' => '661-0044',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '武庫町',
                'address4' => '4丁目11-1',
                'phone_number' => '06-6438-1917'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立武庫北小学校',
                'zipcode' => '661-0046',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '常松',
                'address4' => '2丁目14-1',
                'phone_number' => '06-6431-5100'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立武庫東小学校',
                'zipcode' => '661-0035',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '武庫之荘',
                'address4' => '6丁目15-1',
                'phone_number' => '06-6432-4565'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立武庫庄小学校',
                'zipcode' => '661-0031',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '武庫之荘本町',
                'address4' => '3丁目21-1',
                'phone_number' => '06-6433-6746'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立武庫の里小学校',
                'zipcode' => '661-0041',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '武庫の里',
                'address4' => '1丁目4-1',
                'phone_number' => '06-6433-2080'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立園田小学校',
                'zipcode' => '661-0982',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '食満',
                'address4' => '1丁目1-2',
                'phone_number' => '06-6491-6973'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立園田北小学校',
                'zipcode' => '661-0981',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '猪名寺',
                'address4' => '2丁目4-1',
                'phone_number' => '06-6492-9990'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立園和小学校',
                'zipcode' => '661-0953',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '東園田町',
                'address4' => '4丁目73-2',
                'phone_number' => '06-6491-9504'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立園和北小学校',
                'zipcode' => '661-0951',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '田能',
                'address4' => '1丁目7-1',
                'phone_number' => '06-6492-1066'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立園田東小学校',
                'zipcode' => '661-0953',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '東園田町',
                'address4' => '8丁目7',
                'phone_number' => '06-6491-9253'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立上坂部小学校',
                'zipcode' => '661-0011',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '東塚口町',
                'address4' => '1丁目15-3',
                'phone_number' => '06-6427-3830'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立小園小学校',
                'zipcode' => '661-0974',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '若王寺',
                'address4' => '3丁目23-1',
                'phone_number' => '06-6491-5918'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立園田南小学校',
                'zipcode' => '661-0974',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '若王寺',
                'address4' => '1丁目1-1',
                'phone_number' => '06-6493-6821'
            ],
            [
                'type' => '小学校',
                'name' => '尼崎市立百合学院小学校',
                'zipcode' => '661-0974',
                'address1' => '兵庫県',
                'address2' => '尼崎市',
                'address3' => '若王寺',
                'address4' => '2丁目18-2',
                'phone_number' => '06-6491-7033'
            ],
        ]);
    }
}
