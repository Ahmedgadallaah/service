<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;

class AdressesController extends Controller
{
    public function GetAdresses(){
        $adresses=Address::withTranslations(['en', 'ar'])->get();
        return response()->json([$adresses]);
    }


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
