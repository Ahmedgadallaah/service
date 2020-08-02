<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});


Route::get('users','api\UsersController@getUsers');

Route::post('register', 'api\ApiAuthController@register');
Route::post('login', 'api\ApiAuthController@login');
Route::get('logout', 'api\ApiAuthController@logout');
Route::get('profile', 'api\ApiAuthController@getAuthUser');
Route::get('countries', 'api\CountriesController@GetCountries');
Route::get('services', 'api\ServicesController@GetServices');
Route::get('orders', 'api\OrdersController@GetOrders');
Route::get('offers', 'api\OffersController@GetOffers');
Route::get('cities', 'api\CitiesController@GetCities');
Route::get('addresses', 'api\AdressesController@GetAdresses');
Route::get('user', 'api\ApiAuthController@getAuthUser');
