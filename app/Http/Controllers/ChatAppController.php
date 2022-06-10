<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatAppController extends Controller
{
    public function chatapp(){
        return view ('chatapp.chatapp');
    }
}
