<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;

class AdressesController extends Controller
{
    public function GetAdresses(){
        $adresses=Address::all();

        //dd($address)
        return response()->json([utf8_encode($adresses->location)]);
    }

    //'POINT(7.0115552 51.4556432)',0
    public function store(){

        $address = Address::create([
            'address' => $request->address,
            'location' => $request->location,
            'user_id' =>auth('auth:api')->user()->id,
        ]);
        dd($address);
        return response()->json(['message'=>'Data Successfully Created']);

    }
}
