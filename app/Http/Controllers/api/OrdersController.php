<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
class OrdersController extends Controller
{
    public function GetOrders(){
        $orders=Order::all();
        return response()->json([$orders]);
    }

    public function store(Request $request){


        if($request->has('image')){
            $fileName= 'orders/apis/'.time().$request->image->getClientOriginalName();
            $request->image->move(public_path('../storage/app/public/orders/apis'), $fileName);

        }
        else{
            $fileName='orders/apis/default.jpeg';
        }

         Order::create([
            'date' => $request->date,
            'time' => $request->time,
            'address' => $request->address,
            'description' => $request->description,
            'expire' => $request->expire,
            'name' => $request->name,
            'image' => $fileName,
            'user_id' => auth('api')->user()->id,
            'service_id' => $request->service_id,
        ]);

        return response()->json(['message'=>'Data Successfully Created']);

    }

    public function update(Request $request , $id){
        $order=Order::where('user_id',auth('api')->user()->id)->findOrFail($id);
        if ($request->hasFile('image')){
            $fileName= 'orders/apis/'.time().$request->image->getClientOriginalName();
            $oldImage = $order->image;
            unlink('../storage/app/public/'. $oldImage);

            $request->image->move(public_path('../storage/app/public/orders/apis/'), $fileName);
            $order->image = $fileName;
        }
        else{
            $fileName=$order->image;
        }



        $order->update([
            'date' => $request->date,
            'time' => $request->time,
            'address' => $request->address,
            'description' => $request->description,
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

    public function GetOrders_service($service_id){

        $orders=Order::with('service')->where('service_id',$service_id)->get();
        return response()->json([$orders]);
    }

    public function GetOrders_user(){
        $user_id=auth('api')->user()->id;
        $orders=Order::where('user_id',$user_id)->with('user')->get();
        return response()->json([$orders]);
    }
}
