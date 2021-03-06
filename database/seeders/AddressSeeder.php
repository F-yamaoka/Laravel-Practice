<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'address1'=>'北海道',
            'address2'=>'美唄市',
            'address3'=>'上美唄町南',
            'kana1'=>'ﾎｯｶｲﾄﾞｳ',
            'kana2'=>'ﾋﾞﾊﾞｲｼ',
            'kana3'=>'ｶﾐﾋﾞﾊﾞｲﾁｮｳﾐﾅﾐ',
            'zipcode'=>'0790177',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('addresses')->insert([
			'address1'=> '大阪府',
			'address2'=> '大阪市北区',
			'address3'=> '天神橋',
			'kana1'=> 'ｵｵｻｶﾌ',
			'kana2'=> 'ｵｵｻｶｼｷﾀｸ',
			'kana3'=> 'ﾃﾝｼﾞﾝﾊﾞｼ',
			'zipcode'=> '5300041',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('addresses')->insert([
            'address1'=> '大阪府',
			'address2'=> '池田市',
			'address3'=> '旭丘',
			'kana1'=> 'ｵｵｻｶﾌ',
			'kana2'=> 'ｲｹﾀﾞｼ',
			'kana3'=> 'ｱｻﾋｶﾞｵｶ',
			'zipcode'=> '5630022',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('addresses')->insert([
			'address1'=> '沖縄県',
			'address2'=> '那覇市',
			'address3'=> '赤嶺',
			'kana1'=> 'ｵｷﾅﾜｹﾝ',
			'kana2'=> 'ﾅﾊｼ',
			'kana3'=> 'ｱｶﾐﾈ',
			'zipcode'=> '9010154',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
    }
}
