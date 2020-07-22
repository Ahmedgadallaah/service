<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Service;
use Illuminate\Http\Request;
use TCG\Voyager\Models\User;

class UsersController extends Controller
{
    public function getUsers(){

        $users = User::all();
        return response()->json( $users,200);
    }

}
