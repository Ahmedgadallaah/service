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
}
