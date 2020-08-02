<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Offer;
class OffersController extends Controller
{
    public function GetOffers(){
        $offers=Offer::withTranslations(['en', 'ar'])->get();
        return response()->json([$offers]);
    }
}
