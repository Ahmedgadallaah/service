<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
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


    public function GetOffers_order($order_id){
        // $order=Order::find($order_id);
        $offers=Offer::where('order_id',$order_id)->with('user')->get();
        return response()->json([$offers]);
    }


    public function  Getuser_offers(){

        $offers=Offer::where('user_id',auth('api')->user()->id)->get();
        return response()->json([$offers]);
    }

// get all auth tech orders he made offers on
    public function techOffersOnOrders()
    {
        $tech_offers  =  Offer::where([ ['user_id',auth('api')->user()->id] ])->pluck('order_id')->toArray();
        $tech_orders = Order::whereIn('id',$tech_offers)->where('approve',1)->with('service')->with('offers')->with('user')->get();
        return response()->json([$tech_orders]);

    }

    // get accepted auth tech orders he made offers on
    public function techAcceptedOffersOnOrders()
    {
        $tech_offers  =  Offer::where([ ['user_id',auth('api')->user()->id] , ['type',1] ])->pluck('order_id')->toArray();
        $tech_orders = Order::whereIn('id',$tech_offers)->where('approve',1)->with('service')->with('offers')->with('user')->get();
        return response()->json([$tech_orders]);

    }
    // get pending auth tech orders he made offers on
    public function techPendingOffersOnOrders()
    {
        $tech_offers  =  Offer::where([ ['user_id',auth('api')->user()->id] , ['type',0] ])->pluck('order_id')->toArray();
        $tech_orders = Order::whereIn('id',$tech_offers)->where('approve',1)->with('service')->with('offers')->with('user')->get();
        return response()->json([$tech_orders]);

    }

    // get Rejected auth tech orders he made offers on
    public function techRejectedOffersOnOrders()
    {
        $tech_offers  =  Offer::where([ ['user_id',auth('api')->user()->id] , ['type',2] ])->pluck('order_id')->toArray();
        $tech_orders = Order::whereIn('id',$tech_offers)->where('approve',1)->with('service')->with('offers')->with('user')->get();
        return response()->json([$tech_orders]);

    }
        public function techCompletedOrders()
    {
        $tech_offers  =  Offer::where([ ['user_id',auth('api')->user()->id] , ['type',1] ])->pluck('order_id')->toArray();
        $tech_orders = Order::whereIn('id',$tech_offers)->where('approve',1)->where('status',2)->with('service')->with('offers')->with('user')->with('ratings')->get();

        $avgRate = $tech_orders[0]->ratingsAvg();

        return response()->json(['orders'=>$tech_orders  , 'rating'=> (float) $avgRate ]);

    }

    // get unApplied auth tech orders he made offers on
    public function techUnAppliedOffersOnOrders()
    {
        $tech_offers  =  Offer::where([ ['user_id',auth('api')->user()->id] , ['type',2] ])->pluck('order_id')->toArray();
        $tech_orders = Order::whereNotIn('id',$tech_offers)->where([ ['approve',1],['status',0] ])->with('service')->with('offers')->with('user')->get();
        return response()->json([$tech_orders]);

    }

}
