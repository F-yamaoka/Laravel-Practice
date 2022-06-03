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
            'prefcode'=>'1',
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
			'prefcode'=> '27',
			'zipcode'=> '5300041',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('addresses')->insert([
            'address1'=> '東京都',
            'address2'=> '大島町',
            'address3'=> '',
            'kana1'=> 'ﾄｳｷｮｳﾄ',
            'kana2'=> 'ｵｵｼﾏﾏﾁ',
            'kana3'=> '',
            'prefcode'=> '13',
            'zipcode'=> '1000100',
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
			'prefcode'=> '27',
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
			'prefcode'=> '47',
			'zipcode'=> '9010154',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        
        //https://zipcloud.ibsnet.co.jp/api/search?zipcode=???????
    }
}
