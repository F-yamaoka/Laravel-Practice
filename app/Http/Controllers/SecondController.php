<?php

namespace App\Http\Controllers;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SecondController extends Controller
{
    public function aimai($id= -1){
        if ($id>= 0){
            $msg ='get name like"'.$id.'"';
            $result = DB::table('people')
            ->where('name','like','%'.$id.'%')->get();
        }
        else{
            $msg ='get people records';
            $result =DB::table('people')->get();
        }
        $data =[
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }
    
    public function hashi(){
        $result =[DB::table('people')->first(),DB::table('people')->orderBy('id','desc')->first()];
        $data =[
            'msg' => 'first records and end records',
            'data' => $result,
        ];
        return view('second.view',$data);
    }

    public function pluck(){
        $name = DB::table('people')->pluck('name');
        $value = $name ->toArray();
        $msg = implode(',',$value);
        $result =DB::table('people')->get();
        $data =[
            'msg' => 'AllName : '.$msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }

    public function chunk(){
        $data = ['msg' => '','data'=>[]];
        $msg ='get : ';
        $result =[];
        DB::table('people')
        ->chunkById(2,function($items) use (&$msg, &$result){
            foreach ($items as $item){
                $msg .= $item->id.',';
                $result += array_merge($result,[$item]);
                break;
            }
            return true;
        });
        $data =[
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }

    public function chunkOrderBy(){
        $data = ['msg' => '','data'=>[]];
        $msg ='get : ';
        $result =[];
        DB::table('people')->orderBy('age','asc')
        ->chunk(3,function($items) use (&$msg, &$result){
            foreach ($items as $item){
                $msg .= $item->id.':'.$item->name.'('.$item->age.'),';
                $result += array_merge($result,[$item]);
                break;
            }
            return true;
        });
        $data =[
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }
    
    public function whereAndOr($id){
        if(empty($id)){
            $result = DB::table('people')->get();
        }else{
            $ids =explode(',',$id);
            $msg ='get people.12,15';
            $result = DB::table('people')->whereIn('id',$ids)->get();
        }
        $data =[
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }

    public function page(Request $request){
        $id =$request->query('page');
        $msg = 'show page'.$id;

        $result =DB::table('people')
        ->paginate(3,['*'],'page',$id);

        $data =[
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view2',$data);
    }

    public function model(){
        $msg ='PersonModelTest';
        $result =Person::get();
        $data =[
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }

    public function reject(){
        $msg ='rejectで未成年を除外';
        $result =Person::get()->reject(function($person){
            //20才以下ならtrue
            return $person->age < 20;
        });
        $data =[
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }

    public function diff(){
        $msg ='diff 50才未満かつ20才未満';
        $result = Person::get()->filter(function($person){
            return $person->age < 50;
        });
 
        $result2 = Person::get()->filter(function($person){
            return $person->age < 20;
        });
 
        $result3 = $result->diff($result2);
 
        $data =
        [
            'msg' => $msg,
            'data' => $result2,
        ];
        return view('second.view',$data);
    }

    public function modelKeys(Request $request){
        $msg ='modelKeys IDが偶数のみ';
        $keys = Person::get()->modelKeys();
        $even = array_filter($keys,function($key){
            return $key % 2 == 0;
        });

        $result = Person::get()->only($even);
        $data=
            [
            'msg' => $msg,
            'data' => $result,
            ];
        return view('second.view',$data);
    }

    public function merge(){
        $msg ='show people record';
        $even =Person::get()->filter(function($item){
            return $item->id % 2  ==0;
        });

        $even2 =Person::get() ->filter(function($item){
            return $item->age % 2 == 0;
        });

        $result =$even ->merge($even2);


        $data =
        [
            'msg' => $msg,
            'data' => $result,
        ];
        return view('second.view',$data);
    }

    public function map(){
        $evenData = Person::get()->filter(function($item){
            return $item->id % 2 == 0;
        });

        $msg =$evenData->map(function($item,$key){
            return $item->id.':'.$item->name;
        });
        $data =[
            'msg' => $msg,
            'data' => $evenData,
        ];
        return view('second.view',$data);
    }

    public function fields(){
        $data = Person::get();
        //ヘッダーの取りだし
        $msg = implode(',',Person::get()->fields());
        $data =[
            'msg' => $msg,
            'data' => $data,
        ];
        return view('second.view',$data);
    }

    public function accessa(){
        $data = Person::get();
        //ヘッダーの取りだし
        $msg = implode(',',Person::get()->fields());
        $data =[
            'msg' => $msg,
            'data' => $data,
        ];
        return view('second.view3',$data);
    }

    // second/save/{id}/{name}
    public function save($id,$name){
        $record = Person::find($id);
        $record->name = $name;
        $record->save();
        return redirect('/second/aimai');
    }

    public function search(){
        $data = Person::get();
        $msg = '検索結果';
        $data =[
            'msg' => $msg,
            'data' => $data,
        ];
        return view('second.viewjs',$data);

    }

    public function json($id=-1){
        if($id==-1){
            return Person::get()->toJson();
        }else{
            return Person::find($id)->toJson();
        }
    }
}

