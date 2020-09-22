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


Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify'); // Make sure to keep this as your route name

Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

Route::get('users','api\UsersController@getUsers');
Route::get('user', 'api\ApiAuthController@getAuthUser');
Route::post('register', 'api\ApiAuthController@register');
Route::post('login', 'api\ApiAuthController@login');
Route::get('logout', 'api\ApiAuthController@logout');
Route::get('profile', 'api\ApiAuthController@getAuthUser');
Route::post('update-profile', 'api\ApiAuthController@update');

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
Route::get('orders-of-service/{service_id}', 'api\OrdersController@GetOrders_service');
Route::get('orders-of-user', 'api\OrdersController@GetOrders_user');
Route::get('new_order', 'api\OrdersController@new_order');
Route::get('pending_order', 'api\OrdersController@pending_order');
Route::get('completed_order', 'api\OrdersController@completed_order');
Route::get('rejected_order', 'api\OrdersController@rejected_order');
Route::post('close_order/{id}', 'api\OrdersController@close_order');
Route::post('accept-offer/{id}', 'api\OrdersController@acceptOffer');
Route::post('cancel-order/{id}', 'api\OrdersController@cancel_order');
//---------------------- Offers --------------------------------------
Route::get('offers', 'api\OffersController@GetOffers');
Route::get('user-offers', 'api\OffersController@Getuser_offers');
Route::post('store-offer', 'api\OffersController@store');
Route::post('update-offer/{id}', 'api\OffersController@update');
Route::post('delete-offer/{id}', 'api\OffersController@delete');
Route::get('offers-of-order/{order_id}', 'api\OffersController@GetOffers_order');
Route::get('tech-orders', 'api\OffersController@techOffersOnOrders');
Route::get('tech-accepted-orders', 'api\OffersController@techAcceptedOffersOnOrders');
Route::get('tech-pending-orders', 'api\OffersController@techPendingOffersOnOrders');
Route::get('tech-rejected-orders', 'api\OffersController@techRejectedOffersOnOrders');
Route::get('tech-unapplied-orders', 'api\OffersController@techUnAppliedOffersOnOrders');
Route::get('tech-completed-orders', 'api\OffersController@techCompletedOrders');
//---------------------- Cities --------------------------------------
Route::get('cities', 'api\CitiesController@GetCities');
Route::post('store-city', 'api\CitiesController@store');
Route::post('update-city/{id}', 'api\CitiesController@update');
Route::post('delete-city/{id}', 'api\CitiesController@delete');
//---------------------- Addresses --------------------------------------
Route::get('addresses', 'api\AdressesController@GetAdresses');
Route::get('user-addresses/{user_id}', 'api\AdressesController@GetAdresses_UnAuthuser');
Route::get('address/{id}', 'api\AdressesController@getAddressById');
Route::post('store-address', 'api\AdressesController@store');
Route::get('delete-address/{id}', 'api\AdressesController@delete');
Route::get('activate-address/{id}', 'api\AdressesController@activate_location');


