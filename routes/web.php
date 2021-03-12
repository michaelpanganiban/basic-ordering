<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/manageOrders', 'HomeController@manageOrders')->name('manageOrders');

//DELIVERY
Route::get('/deliveryConfiguration', 'DeliveryConfigurationController@index')->name('deliveryConfiguration');
Route::post('/manageDelivery', 'DeliveryConfigurationController@manageDelivery')->name('manageDelivery');

//DISCOUNT
Route::get('/discountConfiguration', 'DiscountConfigurationController@index')->name('discountConfiguration');
Route::post('/manageDiscount', 'DiscountConfigurationController@manageDiscount')->name('manageDiscount');

//PRODUCT
Route::get('/productConfiguration', 'ProductConfigurationController@index')->name('productConfiguration');
Route::post('/manageProduct', 'ProductConfigurationController@manageProduct')->name('manageProduct');
