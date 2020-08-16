<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Offer;
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


/////////////////////////// Orders Status //////////////////////////////////////////

    public function new_order(){
        $user_id=auth('api')->user()->id;
        $orders=Order::where('user_id',$user_id)->where('expire','>=',date('y-m-d'))
                ->orderBy('id','desc')->with('user')->with('service')->
                take(10)->get();
        return response()->json([$orders]);
    }

    public function pending_order()
    {
        $user_id = auth('api')->user()->id;
        $orders = Order::where('status',0)->where('user_id', $user_id)->with('user')->with('service')->get();
        //$orders = Order::where('user_id', $user_id)->with('user')->pluck('id')->toArray();
        //$offers = Offer::where('status', 0)->whereIn('order_id', $orders)->get();

        return response()->json($orders);
    }

    public function completed_order(){
        $user_id = auth('api')->user()->id;
        $orders = Order::where('status',1)->where('user_id', $user_id)->with('offer')->with('user')->with('service')->get();
        return response()->json($orders);
    }


    public function rejected_order(){
        $user_id = auth('api')->user()->id;
        $orders = Order::where('status',2)->where('user_id', $user_id)->with('user')->with('service')->get();
        return response()->json($orders);
    }

    public function close_order($id){
        $user_id = auth('api')->user()->id;
        $order = Order::where('id',$id)->where('user_id', $user_id)->first();
        if (!$order){
            return response()->json(['error'=>'This Order is not related to this user']);
        }
        $order->update([
            'status' => 1,
        ]);
        return response()->json(['message'=>'Data Successfully Updated']);
    }

}
