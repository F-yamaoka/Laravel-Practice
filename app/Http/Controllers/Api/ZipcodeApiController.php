<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zipcode;
use App\Models\Address;
use DateTime;

class ZipcodeApiController extends Controller
{
    public function zipcode_api(Request $request){
        $address = Zipcode::where('zipcode','=',$request->zipcode)->first();
        return response()->json($address);
    }

   
}
