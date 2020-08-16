<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use Illuminate\Support\Facades\DB;

class AdressesController extends Controller
{

    public function GetAdresses(){

        $addresses = Address::where('user_id',auth('api')->user()->id)->get();
        $array_address = array();
        $i = 0;

        foreach ($addresses as $row_product)
        {
            $point_value = $addresses[$i]["location"];
            $coordinates = unpack('x/x/x/x/corder/Ltype/dlat/dlon', $point_value);
            $array_address [$i]["id"]= $row_product->id;
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



        $lat = (float) $request['lat'];
        $lng = (float) $request['lng'];

         Address::create([
            'address' => $request->address,
            'location' => DB::raw("ST_GeomFromText('POINT({$lng} {$lat})')"),
            'user_id' =>auth('api')->user()->id,
        ]);


        return response()->json(['message'=>'Data Successfully Created']);

    }



    public function delete($id)

    {
       $address =  Address::where('user_id', auth('api')->user()->id)->where('id',$id)->first();
       if (!$address){
           return response()->json(['error'=>'Address not found']);

       }
       $address->delete();

        return response()->json(['message'=>'Data Successfully Deleted']);

    }
     public function activate_location($id)
     {

         $other_addresses = Address::where('user_id', auth('api')->user()->id)->get();
         foreach ($other_addresses as $add){

             $add->update([
                 'status' => 0
             ]);
         }
         $address =  Address::where('user_id', auth('api')->user()->id)->where('id',$id)->first();
         if (!$address){
             return response()->json(['error'=>'This address is not related to this user']);

         }

         $address->update([
             'status' => 1
         ]);


         return response()->json(['message'=>'This address has been activated']);

     }

}
