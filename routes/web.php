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

Route::get('/', function () {
    return view('welcome');
});

Route::get('list','listController@index'); 
Route::post('list','listController@create'); 
Route::post('delete','listController@delete');
Route::post('update','listController@update');
Route::get('search','listController@search');