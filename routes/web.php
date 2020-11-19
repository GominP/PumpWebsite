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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/service', 'HomeController@service')->name('service');
Route::get('/about', 'HomeController@about')->name('about');


//Products
Route::resource('/resource','ProductController');

Route::get('/allProduct/{type_id}', 'ProductController@index')->name('product.index');
Route::get('/allProduct/{product_id}/show', 'ProductController@show')->name('product.show');

//Orders
Route::post('/addOrder', 'OrderController@store')->name('order.store');
Route::get('/Your_Order/{user_id}', 'OrderController@index')->name('order.index');
Route::put('/order_cart','OrderController@order')->name('order.cart.update');
Route::resource('/order','OrderController');











