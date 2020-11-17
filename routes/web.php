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

Route::get('/allProduct/{type_id}', 'Productcontroller@index')->name('product.index');
//Route::get('/allProduct/{type_id}', 'Productcontroller@selectType')->name('product2.index');





