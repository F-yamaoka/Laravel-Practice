<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use DateTime;
class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            'name'=>'testname',
            'context'=>'こんにちは！',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('messages')->insert([
            'name'=>'noname',
            'context'=>'メッセージは改行することが
できます。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('messages')->insert([
            'name'=>'太郎',
            'context'=>'メッセージはCTRL+ENTERでも送信することができます。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);


    }
}
