<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Person extends Model{
    protected $guarded =['id'];
    public $timestamps =false;
    
    public static $rules =[
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer',
    ];




    // 以下自作関数
    public function newCollection(array $models =[]){
        return new MyCollection($models);
    }

    //p.158
    public function getNameAndIdAttribute(){
        return $this->name.'[id='.$this->id.']';
    }
    public function getNameAndMailAttribute(){
        return $this->name.'[mail='.$this->mail.']';
    }
    public function getNameAndAgeAttribute(){
        return $this->name.'[age='.$this->age.']';
    }
    public function getNameAndAllAttribute(){
        return $this->name.'[mail='.$this->mail.'],[age='.$this->age.']';
    }

    //p.159 アクセサ　大文字に変換
    public function getNameAttribute($value){
        return strtoupper($value);
    }

    //p.160 ミューテータ　大文字に変換
    public function setNameAttribute($value){
        $this->attributes['name'] =strtoupper($value);
    }
}

class MyCollection extends Collection{
    public function fields(){
        $item = $this->first();
        return array_keys($item->toArray());
    }
}
// p115