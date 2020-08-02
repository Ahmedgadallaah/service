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
}
