<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThirdController extends Controller
{
    public function name(){
        return view('third.index');
    }
}
