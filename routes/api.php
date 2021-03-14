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


Route::group(['prefix' => '/'], function ($router) {
    Route::post('auth/login', 'HomeController@login');
    Route::post('auth/logout', 'HomeController@logout');
    Route::post('/post/create', 'HomeController@store');
    Route::get('/home', 'HomeController@index');
    Route::delete('/post/delete/{id}', 'HomeController@delete');
});

Route::group(['prefix' => '/phone'], function ($router) {
    Route::post('/login','PhoneHomeController@login');
    Route::post('/phone','PhoneHomeController@phone');
    Route::post('/retrieve','PhoneHomeController@retrieve');
    Route::post('/updateimage','PhoneHomeController@updateImage');
    Route::post('/updatebackground','PhoneHomeController@updateBackground');
    Route::post('/updateimageSer','PhoneHomeController@updateImageSer');
    Route::post('/updatebackgroundSer','PhoneHomeController@updateBackgroundSer');
    Route::post('/getservice','PhoneHomeController@getService');
    Route::post('/getpost','PhoneHomeController@getListPost');
    Route::post('/checklike', 'PhoneHomeController@checklike');
    Route::post('/like', 'PhoneHomeController@like');
    Route::post('/serviceretrive','PhoneHomeController@downloadJsonUserService');
    Route::post('/register','PhoneHomeController@Register');
    Route::post('/uploadpost','PhoneHomeController@Uploadpost');
    
    
});

