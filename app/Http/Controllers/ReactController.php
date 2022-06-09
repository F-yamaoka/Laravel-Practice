<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use DateTime;
use App\Models\Zipcode;
class ReactController extends Controller
{
    public function reactapp(){
        return view ('zipcode.reactapp');
    }
    
    public function insert(Request $request){
        $data = Zipcode::where('zipcode','=',$request->zipcode)->first();

        if(empty($data)){
            if(isset($data['message'])){
                $msg = $data['message'];
            }else{
                $msg = '不明なエラー';
            }
        }else{
            $address = new Address;
            $address ->address1 = $data['address1'];
            $address ->address2 = $data['address2'];
            $address ->address3 = $data['address3'];
            $address ->kana1 =  $data['kana1'];
            $address ->kana2 = $data['kana2'];
            $address ->kana3 = $data['kana3'];
            $address ->zipcode =  $data['zipcode'];
            $address ->created_at = new DateTime();
            $address ->updated_at = new DateTime();
            $address->save();
            $msg = '保存しました(〒'.$request->zipcode.')';
        }
        return response($msg,200);
    }
    
    public function delete(Request $request){
        $address = Address::find($request->id);

        if(isset($address)){
            $msg ='削除しました(〒'.$address->zipcode.')';
            $address->delete();
        }else{
            $msg ='error(対象IDが存在しない)';
        }
        return response($msg,200);
    }

    // 外部API　使用しない
    public function zipcode_api(Request $request){
/*         $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode='.$request->zipcode;

        $options = array(
            'http' => array(
            'method'=> 'GET',
            'header'=> 'Content-type: application/json; charset=UTF-8' //JSON形式で表示
            )
        );
        $context = stream_context_create($options);
        $json = file_get_contents($url, false,$context);
        return response()->json($json); */
    }

    public function address_api(){
        $addresses = Address::all(); 
        return response()->json($addresses,200);
    }
    
}
