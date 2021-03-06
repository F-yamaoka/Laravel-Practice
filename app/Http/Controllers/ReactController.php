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
        $delete_address = Address::find($request->id);

        if(isset($delete_address)){
            $msg ='削除しました(〒'.$delete_address->zipcode.')';
            $delete_address->delete();
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

    public function download(){
    // コールバック関数に１行ずつ書き込んでいく処理を記述
        $callback = function (){
        // 出力バッファをopen
        $stream = fopen('php://output', 'w');
        // 文字コードをShift-JISに変換
        stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
        // ヘッダー行
        fputcsv($stream, [
            'id',
            'address1',
            'address2',
            'address3',
            'kana1',
            'kana2',
            'kana3',
            'zipcode',
            'created_at',
            'update_at',
        ]);
        $addresses = Address::orderBy('id', 'desc');
        foreach ($addresses->cursor() as $address) {
            fputcsv($stream, [
                $address->id, 
                $address->address1,
                $address->address2,
                $address->address3,
                $address->kana1,
                $address->kana2,
                $address->kana3,
                $address->zipcode,
                $address->created_at,
                $address->update_at,
            ]);
            }
            fclose($stream);
        };
	
        $filename = sprintf('all_address_%s.csv', date('Ymd'));
        
        $header = [
            'Content-Type' => 'application/octet-stream',
        ];
        
        return response()->streamDownload($callback, $filename, $header);
    }

    public function insert_random_address($count = 1){
        for ($i = $count ; $i > 0 ; $i--){
            $random_id = rand(1,127343);
            $random_address = Zipcode::find($random_id);
            $insert_address = new Address;
            $insert_address->address1    = $random_address->address1;
            $insert_address->address2    = $random_address->address2;
            $insert_address->address3    = $random_address->address3;
            $insert_address->kana1       = $random_address->kana1;
            $insert_address->kana2       = $random_address->kana2;
            $insert_address->kana3       = $random_address->kana3;
            $insert_address->zipcode     = $random_address->zipcode;
            $insert_address->created_at  = new DateTime();
            $insert_address->updated_at  = new DateTime();
            $insert_address ->save();
        }
        return response($count .'件追加しました。',200);
    }
}
