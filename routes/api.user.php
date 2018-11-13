<?php

Route::group([
        'middleware' => 'api'
    ], function () {
        Route::post('register', 'User\UserController@register')->name('userregister');
        Route::post('login', 'User\UserController@login')->name('userlogin');
});

Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', 'User\UserController@logout')->name('logout');

        Route::group([
            'prefix' => 'novel'
        ], function () {
            Route::post('toc', 'Novel\NovelController@getChapters')->name('tableofcontents');
            Route::post('favorites', 'Novel\NovelController@getUserFavoriteNovels')->name('favoritenovels');
            Route::post('togglefavorite', 'Novel\NovelController@toggleFav')->name('readchapter');

            Route::post('read', 'Chapter\ChapterController@read')->name('readchapter');
        });
});

