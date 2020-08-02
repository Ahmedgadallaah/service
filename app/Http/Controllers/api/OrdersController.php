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
}
