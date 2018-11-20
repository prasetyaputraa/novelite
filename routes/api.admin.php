<?php

Route::group([
        'middleware' => 'api'
    ], function () {
        Route::post('register', 'User\UserController@register')->name('userregister');
        Route::post('login', 'Admin\AdminController@login')->name('adminlogin');
});

Route::group([
        'middleware' => ['api', 'multiauth:admin']
    ], function () {
        Route::post('logout', 'Admin\AdminController@logout')->name('logout');

        Route::group([
            'prefix' => 'novel'
        ], function () {
            Route::post('toc', 'Novel\NovelController@getChapters')->name('tableofcontents');
            Route::post('explore', 'Novel\NovelController@explore')->name('explore');
            Route::post('favorites', 'Novel\NovelController@getFavoriteNovels')->name('favoritenovels');
            Route::post('togglefavorite', 'Novel\NovelController@toggleFavorite')->name('readchapter');

            Route::post('read', 'Chapter\ChapterController@read')->name('readchapter');
        });
});

