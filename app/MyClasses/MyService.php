<?php
namespace App\MyClasses;

class MyService{
    private $serial;
    private $id =-1;
    private $msg ="Hello! this is My Service! but No ID";
    private $data =['Hello','Welcome','Bye'];

    function __construct(){
        $this->serial=rand();
        if(config('singlton_flag')){
        echo "MyService__construct ==> ['".$this->serial."']<br>";
        }
    }

    public function setId($id){
        $this ->id;
        //echo "function setID is CALLED <br>ID: {$id}<br>";
        if ($id >= 0 && $id < count($this->data)){
            $this ->msg ="select id is'".$id."'".",and data are'".$this->data[$id]."'";
        }

    }

    public function say(){
        return $this->msg;
    }

    public function data(int $id){
        return $this ->data[$id];
    }

    public function alldata(){
        return $this ->data;
    }
}