<?php

Route::group([
        'middleware' => 'api'
    ], function () {
        Route::post('', 'Novel\NovelController@explore')->name('home');
});

Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('explore', 'Novel\NovelController@explore')->name('explore');
        Route::post('favorite', 'Novel\NovelController@toggleFavorite')->name('favorite');
});

