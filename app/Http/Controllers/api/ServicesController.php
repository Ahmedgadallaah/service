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
}
