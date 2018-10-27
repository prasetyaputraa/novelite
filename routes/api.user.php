<?php

//Route::get('/{id}', 'User\UserController@index')->name('userhome');

Route::post('login', 'User\UserController@login')->name('userlogin');
Route::post('register', 'User\UserController@register')->name('userregister');

//Route::group(['prefix' => 'novel', 'as' => 'banner.'], function() {
//  Route::get('/', 'Member\HomeBannerController@index')->name('list');
//  Route::get('/create', 'Member\HomeBannerController@create')->name('create');
//
//  //Route::post('/', 'Member\HomeBannerController@store')->name('store');
//
//  Route::get('/banner', 'Member\HomeBannerController@edit')->name('edit');
//  Route::patch('/{banner}', 'Member\HomeBannerController@update')->name('update');
//
//  Route::delete('/{banner}', 'Member\HomeBannerController@store')->name('destroy');


//use Illuminate\Http\Request;

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
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
