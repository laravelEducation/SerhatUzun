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

Route::group(['namespace'=>'App\Http\Controllers\api'],function (){

    Route::get('/working-hours/{date?}','indexController@getWorkingHours');
    Route::post('/appointment-store','indexController@appointmentStore');

    Route::group(['namespace'=>'admin','prefix'=>'admin'],function (){

        Route::post('/process','indexController@process');
        Route::get('/list','indexController@getList');
        Route::get('/today-list','indexController@getTodayList');
        Route::get('/last-list','indexController@getLastList');
        Route::get('/waiting-list','indexController@getWaitingList');
        Route::get('/cancel-list','indexController@getCancelList');


    });


});
