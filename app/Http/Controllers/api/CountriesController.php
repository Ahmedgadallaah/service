<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Country;
class CountriesController extends Controller
{
    public function GetCountries(){
        $countries=Country::withTranslations(['en', 'ar'])->get();
        return response()->json([$countries]);
    }

    public function store(Request $request){

        $country = Country::create([
            'name' => $request->name,
        ]);
        return response()->json(['message'=>'Data Successfully Created']);

    }

    public function update(Request $request , $id){
        $country=Country::findOrFail($id);
        $country->update([
            'name' => $request->name,
        ]);
        return response()->json(['message'=>'Data Successfully Updated']);

    }


    public function delete($id){
        $country=Country::find($id);
        $country->delete();
        return response()->json(['message'=>'Data Successfully Deleted']);

    }
}
