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
            'context'=>'通常のメッセージ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('messages')->insert([
            'name'=>'testname',
            'context'=>'改行されたメッセージ
改行一回
改行二回',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('messages')->insert([
            'name'=>'テストその3',
            'context'=>'ファイルが文字化けした場合の対処方法
            CSVファイルを右クリックし、「プログラムから開く」→「メモ帳」を選択します。
            メモ帳で開いた際に文字化けしていない事を確認し、「ファイル」→「名前をつけて保存」を選択し、表示されたダイアログボックス上の「文字コード」を「ANSI」に変更の上、保存します。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);


    }
}
