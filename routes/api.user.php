<?php

Route::group([
        'middleware' => 'api'
    ], function () {
        Route::post('login', 'User\UserController@login')->name('userlogin');
        Route::post('register', 'User\UserController@register')->name('userregister');
});

Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', 'User\UserController@logout')->name('logout');
});

