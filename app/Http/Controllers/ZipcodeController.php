<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use Datetime;

class ZipcodeController extends Controller
{
    // React画面
    public function zipcode(){
        return view('zipcode.zipcode');
    }

    // 一覧表示
    public function view(){
        $addresses = Address::all(); 
        $data=[
            'msg' => '住所一覧',
            'data' =>$addresses,
        ];
        return view('zipcode.view',$data);
    }

    // 追加
    public function add(Request $request){
        $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode='.$request->zipcode1.$request->zipcode2;

        $options = array(
            'http' => array(
            'method'=> 'GET',
            'header'=> 'Content-type: application/json; charset=UTF-8' //JSON形式で表示
            )
        );
        
        $context = stream_context_create($options);
        $raw_data = file_get_contents($url, false,$context);
        $data = json_decode($raw_data,true);
        if(empty($data['results'][0])){
            if(isset($data['message'])){
                $msg = $data['message'];
            }else{
                $msg = '不明なエラー';
            }
        }else{
            $address = new Address;
            $address ->address1 = $data['results'][0]['address1'];
            $address ->address2 = $data['results'][0]['address2'];
            $address ->address3 = $data['results'][0]['address3'];
            $address ->kana1 =  $data['results'][0]['kana1'];
            $address ->kana2 = $data['results'][0]['kana2'];
            $address ->kana3 = $data['results'][0]['kana3'];
            $address ->prefcode = $data['results'][0]['prefcode'];
            $address ->zipcode =  $data['results'][0]['zipcode'];
            $address ->created_at = new DateTime();
            $address ->updated_at = new DateTime();
            $address->save();
            $msg = 'Address : '
            .$data['results'][0]['address1']
            .$data['results'][0]['address2']
            .'( 〒'
            .$request->zipcode1
            .'-'.$request->zipcode2
            .' ) -> save!';
        }

        $addresses = Address::all();
        $data=[
            'msg' =>$msg,
            'data' =>$addresses,
        ];
        
        return view('zipcode.view',$data);
    }

    public function delete($id = -1){
        if($id==-1){
            $msg ='住所一覧';
        }else{
            $address = Address::find($id);
            if(isset($address)){
                $address->delete();
            }
            $msg = "削除しました。(ID : ".$id.')';
        }
        $data=[
            'msg' =>$msg,
            'data' =>Address::all(),
        ];
        
        return view('zipcode.view',$data);
    }    

    public function reactapp(){
        return view ('zipcode.reactapp');
    }
}
