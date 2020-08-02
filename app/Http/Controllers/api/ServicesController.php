<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
class ServicesController extends Controller
{
    public function GetServices(){
        $services=Service::withTranslations(['en', 'ar'])->get();
        return response()->json([$services]);

    }

      public function store(Request $request){

        $service = Service::create([
            'name' => $request->name,

        ]);
        return response()->json(['message'=>'Data Successfully Created']);

    }

    public function update(Request $request , $id){
        $service=Service::findOrFail($id);
        $service->update([
            'name' => $request->name,

        ]);
        return response()->json(['message'=>'Data Successfully Updated']);

    }


    public function delete($id){
        $service=Service::find($id);
        $service->delete();
        return response()->json(['message'=>'Data Successfully Deleted']);

    }
}
