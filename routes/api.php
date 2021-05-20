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

Route::group(['namespace' => 'Common', 'prefix' => 'common', 'middleware' => ['operation.log']], function () {
    Route::post('/test', 'CommonController@test');
    Route::post('/fileUpload', 'CommonController@fileUpload');
});

Route::group(['namespace' => 'Elf', 'prefix' => 'elf', 'middleware' => ['operation.log']], function () {
    Route::post('/edit', 'ElfController@editElf');
    Route::get('/detail', 'ElfController@getElfDetail');
    Route::post('/delete', 'ElfController@deleteElf');
    Route::get('/list', 'ElfController@getElfList');
});

Route::group(['namespace' => 'Scene', 'prefix' => 'scene', 'middleware' => ['operation.log']], function () {
    Route::post('/edit', 'SceneController@editScene');
    Route::get('/detail', 'SceneController@getSceneDetail');
    Route::post('/delete', 'SceneController@deleteScene');
    Route::get('/list', 'SceneController@getSceneList');
});