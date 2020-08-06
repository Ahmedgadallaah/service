<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Offer;
class OffersController extends Controller
{
    public function GetOffers(){
        $offers=Offer::all();
        return response()->json([$offers]);
    }


    public function store(Request $request){



        $offer = Offer::create([
            'price' => $request->price,
            'user_id' => auth('api')->user()->id,
            'order_id' => $request->order_id,
        ]);
        return response()->json(['message'=>'Data Successfully Created']);
    }
    public function update(Request $request , $id){
        $offer=Offer::findOrFail($id);
        $offer->update([
            'price' => $request->price,
            'type' => $request->type,
        ]);
        return response()->json(['message'=>'Data Successfully Updated']);

    }


    public function delete($id){
        $offer=Offer::find($id);
        $offer->delete();
        return response()->json(['message'=>'Data Successfully Deleted']);

    }
}
