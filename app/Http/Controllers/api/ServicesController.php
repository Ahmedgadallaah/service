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

        $fileName= 'services/apis/'.time().$request->image->getClientOriginalName();
        $request->image->move(public_path('../storage/app/public/services/apis'), $fileName);
        $service = Service::create([
            'name' => $request->name,
            'image' => $fileName,
        ]);
        return response()->json(['message'=>'Data Successfully Created']);

    }

    public function update(Request $request , $id){
        $service=Service::findOrFail($id);
        if ($request->hasFile('image')){
            $fileName= 'services/apis/'.time().$request->image->getClientOriginalName();
            $oldImage = $service->image;
            unlink('../storage/app/public/'. $oldImage);

            $request->image->move(public_path('../storage/app/public/services/apis/'), $fileName);
            $service->image = $fileName;
        }



        $service->update([
            'name' => $request->name,
            'image' => $fileName,
        ]);
        return response()->json(['message'=>'Data Successfully Updated']);

    }


    public function delete($id){
        $service=Service::find($id);
        $service->delete();
        return response()->json(['message'=>'Data Successfully Deleted']);

    }
}
