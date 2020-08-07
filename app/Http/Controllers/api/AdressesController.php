<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;

class AdressesController extends Controller
{

    public function GetAdresses(){

        $addresses = Address::all();
        $array_address = array();
        $i = 0;

        foreach ($addresses as $row_product)
        {
            $point_value = $addresses[$i]["location"];
            $coordinates = unpack('x/x/x/x/corder/Ltype/dlat/dlon', $point_value);
            $array_address [$i]["address"]= $row_product->address;
            $array_address [$i]["user_id"]= $row_product->user_id;
            $array_address [$i]["lat"]= $coordinates['lat'];
            $array_address [$i]["lon"]= $coordinates['lon'];
            $i++;
        }

        return response()->json($array_address) ;

  }



//'POINT(7.0115552 51.4556432)',0
    public function store(Request $request){


         Address::create([
            'address' => $request->address,
//            'location' => $request->location,
            'location' => \DB::raw("public.ST_GeomFromText('7.0115552 51.4556432'::text)"),

            'user_id' =>auth('api')->user()->id,
        ]);


        return response()->json(['message'=>'Data Successfully Created']);

    }


}
