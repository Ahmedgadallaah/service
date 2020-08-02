<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
class OrdersController extends Controller
{
    public function GetOrders(){
        $orders=Order::withTranslations(['en', 'ar'])->get();
        return response()->json([$orders]);
    }

    public function store(Request $request){


            $fileName= 'orders/apis/'.time().$request->image->getClientOriginalName();
            $request->image->move(public_path('../storage/app/public/orders/apis'), $fileName);

        $order = Order::create([
            'date' => $request->date,
            'time' => $request->time,
            'address' => $request->address,
            'description' => $request->description,
            'money' => $request->money,
            'expire' => $request->expire,
            'name' => $request->name,
            'image' => $fileName,
            'user_id' => auth('api')->user()->id,
            'service_id' => $request->service_id,
        ]);

        return response()->json(['message'=>'Data Successfully Created']);

    }

    public function update(Request $request , $id){
        $order=Order::findOrFail($id);
        if ($request->hasFile('image')){
            $fileName= 'orders/apis/'.time().$request->image->getClientOriginalName();
            $oldImage = $order->image;
            unlink('../storage/app/public/'. $oldImage);

            $request->image->move(public_path('../storage/app/public/orders/apis/'), $fileName);
            $order->image = $fileName;
        }


        $order->update([
            'date' => $request->date,
            'time' => $request->time,
            'address' => $request->address,
            'description' => $request->description,
            'money' => $request->money,
            'expire' => $request->expire,
            'name' => $request->name,
            'image' => $fileName,
            'service_id' => $request->service_id,
        ]);
        return response()->json(['message'=>'Data Successfully Updated']);

    }


    public function delete($id){
        $order=Order::find($id);
        unlink('../storage/app/public/'. $order->image);
        $order->delete();
        return response()->json(['message'=>'Data Successfully Deleted']);

    }
}
