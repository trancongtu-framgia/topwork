<?php

Route::get('/', 'HomeController@index')->middleware('check.admin');

Route::get('change-lang/{lang}', 'LangController@changeLang')->name('change-lang');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group([
        'prefix' => 'admin',
        'middleware' => 'auth',
    ],
    function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::resource('roles', 'RoleController');
        Route::resource('job-types', 'JobTypeController');
        Route::resource('locations', 'LocationController');
        Route::group([
            'prefix' => 'categories',
        ], function () {
            Route::get('/', 'CategoryController@index')->name('categories.index');
            Route::get('/create', 'CategoryController@create')->name('categories.create');
            Route::post('/', 'CategoryController@store')->name('categories.store');
            Route::get('edit/{id}', 'CategoryController@edit')->name('categories.edit');
            Route::put('update/{id}', 'CategoryController@update')->name('categories.update');
            Route::delete('destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
        });
    }
);
