<?php

namespace App\Http\Controllers\Api;
use App\Models\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function address(){
        $addresses = Address::all(); 
        return response()->json($addresses,200);
    }
}
