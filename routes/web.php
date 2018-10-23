<?php

    Route::get('change-lang/{lang}', 'LangController@changeLang')->name('change-lang');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(
        [
            'prefix' => 'admin'
        ],
        function () {
            Route::get('/', 'AdminController@index')->name('admin.index');

            Route::resource('roles', 'RoleController');

            Route::resource('job-types', 'JobTypeController');
        }
    );
