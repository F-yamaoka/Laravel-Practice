<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;

class ReactController extends Controller
{
    public function reactapp(){
        return view ('zipcode.reactapp');
    }
    
    public function add(){

    }
    
    public function delete(Request $request){
        $address = Address::find($request->id);

        if(isset($address)){
            $msg ='削除しました(zipcode :'.$address->zipcode.')';
            $address->delete();
        }else{
            $msg ='error(対象IDが存在しない)';
        }
        return response($msg,200);
    }

    public function zipcode_api(Request $request){
        $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode='.$request->zipcode;

        $options = array(
            'http' => array(
            'method'=> 'GET',
            'header'=> 'Content-type: application/json; charset=UTF-8' //JSON形式で表示
            )
        );
        $context = stream_context_create($options);
        $json = file_get_contents($url, false,$context);
        return response()->json($json);
    }

    public function address_api(){
        $addresses = Address::all(); 
        return response()->json($addresses,200);
    }
}
