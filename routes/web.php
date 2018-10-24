<?php

Route::get('/', 'HomeController@index')->middleware('check.admin');

Route::get('change-lang/{lang}', 'LangController@changeLang')->name('change-lang');

Auth::routes();

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
        Route::group([
            'prefix' => 'skills',
        ], function () {
            Route::get('/', 'SkillController@index')->name('skills.index');
            Route::get('/create', 'SkillController@create')->name('skills.create');
            Route::post('/', 'SkillController@store')->name('skills.store');
            Route::get('edit/{id}', 'SkillController@edit')->name('skills.edit');
            Route::put('update/{id}', 'SkillController@update')->name('skills.update');
            Route::delete('destroy/{id}', 'SkillController@destroy')->name('skills.destroy');
        });
    }
);
Route::group(
    [
        'prefix' => 'companies'
    ],
    function () {
        Route::get('/', 'CompanyController@index')->name('companies.index');
        Route::get('/edit', 'CompanyController@edit')->name('companies.edit');
        Route::put('/update', 'CompanyController@update')->name('companies.update');
    }
);
