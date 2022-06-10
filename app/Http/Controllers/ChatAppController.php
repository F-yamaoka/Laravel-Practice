<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Datetime;
class ChatAppController extends Controller
{
    public function chatapp(){
        return view ('chatapp.chatapp');
    }

    public function getMessage(){
        $all_message = Message::all();
        return response()->json($all_message);
    }
    public function sendMessage(Request $request){
        $msg = '';
        $errmsg = '';
        if (!isset($request -> name)) $errmsg .= 'ユーザー名がありません。\n';
        if (!isset($request -> context)) $errmsg .= 'メッセージがありません。\n';

        if (empty($errmsg)) {
            //　保存
            $insertmsg = new Message();
            $insertmsg -> name = $request ->name;
            $insertmsg -> context = $request ->context;
            $insertmsg -> created_at = new DateTime();
            $insertmsg -> updated_at = new DateTime();
            $insertmsg -> save();
            $msg = '送信しました。';
        }else{
            $errmsg .= '送信に失敗しました。\n';
        }

        $response_msg = [
            'errmsg' => $errmsg,
            'msg' =>$msg,
        ];
        return response()->json($response_msg);
    }
}
