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
Route::get('user', 'api\ApiAuthController@getAuthUser');
Route::post('register', 'api\ApiAuthController@register');
Route::post('login', 'api\ApiAuthController@login');
Route::get('logout', 'api\ApiAuthController@logout');
Route::get('profile', 'api\ApiAuthController@getAuthUser');

//---------------------- country --------------------------------------
Route::get('countries', 'api\CountriesController@GetCountries');
Route::post('store-country', 'api\CountriesController@store');
Route::post('update-country/{id}', 'api\CountriesController@update');
Route::post('delete-country/{id}', 'api\CountriesController@delete');
//---------------------- Services --------------------------------------
Route::get('services', 'api\ServicesController@GetServices');
Route::post('store-service', 'api\ServicesController@store');
Route::post('update-service/{id}', 'api\ServicesController@update');
Route::post('delete-service/{id}', 'api\ServicesController@delete');
//---------------------- Orders --------------------------------------
Route::get('orders', 'api\OrdersController@GetOrders');
Route::post('store-order', 'api\OrdersController@store');
Route::post('update-order/{id}', 'api\OrdersController@update');
Route::post('delete-order/{id}', 'api\OrdersController@delete');
//---------------------- Offers --------------------------------------
Route::get('offers', 'api\OffersController@GetOffers');
Route::post('store-offer', 'api\OffersController@store');
Route::post('update-offer/{id}', 'api\OffersController@update');
Route::post('delete-offer/{id}', 'api\OffersController@delete');

//---------------------- Cities --------------------------------------
Route::get('cities', 'api\CitiesController@GetCities');
Route::post('store-city', 'api\CitiesController@store');
Route::post('update-city/{id}', 'api\CitiesController@update');
Route::post('delete-city/{id}', 'api\CitiesController@delete');
//---------------------- Addresses --------------------------------------
Route::get('addresses', 'api\AdressesController@GetAdresses');


