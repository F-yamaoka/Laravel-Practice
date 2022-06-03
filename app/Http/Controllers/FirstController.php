<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myclasses\MyService;
use Illuminate\Support\Facades\DB;
class FirstController extends Controller
{
    function __construct(MyService $myservice)
    {   
        if(config('singlton_flag')){
            echo 'Controller__Construct{<br>';
        }
        $myservice = app('App\MyClasses\MyService');

        if(config('singlton_flag')){
            echo '}<br>';
        }

    
    }

    public function index(){
        return view ('index');
    }

    public function request(Request $request){

        $msg= 'please input text:';
        if($request->isMethod('post')){
            $temp_msg = DB::table('people')->where('name','=',$request->input('msg'))->get();
            $msg =' you typed:"'.$request->input('msg').'"'.'<br>'.$temp_msg;

        }
        $data = [
            'msg' =>$msg,
        ];

        return view('First.request',$data);
    }

    public function request2(Request $request){

        $msg= 'please input text:';
        $keys =[];
        $values =[];
        if($request->isMethod('post')){
            $form = $request->all();
            $keys =array_keys($form);
            $values =array_values($form);
        }
        $data = [
            'msg' =>$msg,
            'keys' =>$keys,
            'values' =>$values,
        ];

        return view('First/request2',$data);
    }

    //
    // 
    // 引数でserviceインスタンスを生成する
    public function service(MyService $myservice){

        $data =[
            'msg' =>$myservice->say(),
            'data'=>$myservice->alldata(),
        ];
        return view('First.service',$data);
    }

    //
    // 引数なし
    // serviceインスタンスを直接生成する
    public function service2(Myservice $myservice ,int $id = -1){
        // appヘルパ関数からインスタンスの生成
        // $myservice =app('App\Myclasses\MyService');
        // $myservice =app()->makewith('App\Myclasses\MyService',['id'=>$id]);

        $myservice->setId($id);
        $data =[
            'msg' =>$myservice->say(),
            'data'=>$myservice->alldata(),
        ];
        return view('First.service',$data);
    }

    public function service3(MyService $myservice, int $id=-1){
        $myservice->setId($id);
        $data = [
            'msg' =>$myservice->say(),
            'data'=>$myservice->alldata(),
        ];
        return view('First.service',$data);
    }
}
