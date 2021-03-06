<?php

use Illuminate\Http\Request;

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

Route::post('/store', 'OrderController@store')->name('store');
Route::match(['get', 'post'],'/update/{order}', 'OrderController@update')->name('update');
Route::get('/orderlist', 'OrderController@index')->name('index.order');