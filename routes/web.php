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


Route::group(['namespace' => 'Common', 'prefix' => 'common', 'middleware' => ['operation.log']], function () {
    Route::get('test', 'CommonController@test');
    Route::get('banner/list', 'CommonController@getBannerList');
});

