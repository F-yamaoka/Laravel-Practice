<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JavascriptController extends Controller
{
    public function index(){
        return view('javaScriptPractice.index');
    } 

    public function index2(){
        return view('javaScriptPractice.index2');
    } 

    public function calculator(){
        return view('javaScriptPractice.calculator');
    }
}
