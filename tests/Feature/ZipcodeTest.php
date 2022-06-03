<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithoutMiddleware;
class zipcode extends TestCase
{
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_各ページへのアクセスが正しく行われているか(){
        // トップページへのアクセス
        $response = $this->get('/zipcode');
        $response->assertStatus(200);

        // 一覧ページへのアクセス
        $response = $this->get('/zipcode/view');
        $response ->assertStatus(200);

        // APIへのアクセス
        $token[] ='dummy';
        $response = $this->session($token)->post('/zipcode/view',['zipcode1'=>'1','zipcode2'=>'1']);
        $response->assertStatus(200);

        // 存在しないIDの削除ページへのアクセスがリダイレクトされるか
        $response = $this->get('/zipcode/view/delete/0');
        $response->assertStatus(200);
    }

    public function test_zipcodeapiを通して取得した住所がデータベースに正しく追加されているか(){
        $testzipcode1 = '100';
        $testzipcode2 = '0100';
        $token[] = 'dummy';

        $response = $this->session($token)->post('/zipcode/view',['zipcode1'=>$testzipcode1,'zipcode2'=>$testzipcode2]);
        $response->assertStatus(200);

        // 該当データが存在しているか
        $testcolum = Address::where('zipcode','=',$testzipcode1.$testzipcode2)->first();        
        $this->assertTrue(isset($testcolum));

        // DBに登録されているか
        echo $testzipcode1.$testzipcode2;
            echo $testcolum->address1;
            $this->assertEquals("東京都",$testcolum->address1);
            $this->assertEquals("ﾄｳｷｮｳﾄ",$testcolum->kana1);
            $this->assertEquals("ｵｵｼﾏﾏﾁ",$testcolum->kana2);
            $this->assertEquals("13",$testcolum->prefcode);
            $this->assertEquals("1000100",$testcolum->zipcode);
    }

    public function test_テスト中に追加されたテスト用データがdeleteボタンから削除できるか(){
        $testzipcode1 = '100';
        $testzipcode2 = '0100';
        
        // 該当データ最初存在しているか
        $testcolum = Address::where('zipcode','=',$testzipcode1.$testzipcode2)->first();
        $this->assertTrue(isset($testcolum));

        // 該当データを削除
        $response =$this->get('/zipcode/view/delete/'.$testcolum->id);
        $response->assertStatus(200);

        // 該当データ削除されて存在していないか
        $testcolum = Address::where('zipcode','=',$testzipcode1.$testzipcode2)->first();
        $this->assertFalse(isset($testcolum));
    }

}
