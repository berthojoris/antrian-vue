<?php

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

Route::get('/', 'HomeController@dashboard')->name('dashboard');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/list', 'HomeController@list')->name('list');
Route::match(['get', 'post'],'/create', 'OrderController@create')->name('create')->middleware('auth');
Route::get('/editstatus', 'OrderController@editstatus')->name('editstatus')->middleware('auth');
Route::get('/editstatus/{id}/status/{status}', 'OrderController@edit')->name('edit')->middleware('auth');
Route::get('/delete/{id}', 'OrderController@destroy')->name('delete')->middleware('auth');

