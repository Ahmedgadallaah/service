<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\City;
class CitiesController extends Controller
{
    public function GetCities(){
        $cities=City::withTranslations(['en', 'ar'])->get();
        return response()->json([$cities]);
    }


    public function store(Request $request){

        $city = City::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);
        return response()->json(['message'=>'Data Successfully Created']);

    }

    public function update(Request $request , $id){
        $city=City::findOrFail($id);
        $city->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);
        return response()->json(['message'=>'Data Successfully Updated']);

    }


    public function delete($id){
        $city=City::find($id);
        $city->delete();
        return response()->json(['message'=>'Data Successfully Deleted']);

    }
}
