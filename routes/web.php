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
Route::resource('/product','ProductController');
Route::get('/allProduct/{type_id}', 'ProductController@index')->name('product.index');
Route::get('/allProduct/{product_id}/show', 'ProductController@show')->name('product.show');
Route::get('/allProduct/{product_id}/edit', 'ProductController@editProduct')->name('product.show.edit');
Route::put('/allProduct/{product_id}/update', 'ProductController@updateProduct')->name('product.show.update');




//Orders
Route::resource('/order','OrderController');
Route::post('/addOrder', 'OrderController@store')->name('order.store');
Route::get('/Your_Order', 'OrderController@index')->name('order.index');
Route::get('/edit', 'OrderController@editOrder')->name('order.edit');
Route::get('/Show_Order/{order_number}', 'OrderController@showDetailOrder')->name('order.show.detail');
Route::put('/order_cart','OrderController@order')->name('order.cart.update');
Route::put('/order_confirm{order}','OrderController@orderConfirm')->name('order.confirm.update');
Route::put('/order_delivery{order}','OrderController@orderDelivery')->name('order.delivery.update');
Route::delete('/order_delete/{order}','OrderController@deleteFormOrderID')->name('order.delete.num');














