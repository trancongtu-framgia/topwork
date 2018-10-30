<?php
Route::get('change-lang/{lang}', 'LangController@changeLang')->name('change-lang');

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
], function () {
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
        Route::post('/category/{id}', 'SkillController@getSkillByCategory');
    });
}
);

Route::group([
    'prefix' => 'companies',
],
    function () {
        Route::get('/', 'CompanyController@index')->name('companies.index');
        Route::get('/edit', 'CompanyController@edit')->name('companies.edit');
        Route::put('/update', 'CompanyController@update')->name('companies.update');
    }
);

Route::group([
    'prefix' => 'client-candidate',
], function () {
    Route::get('candidates/profile/{id}', 'CandidateController@getInfoCandidate')->name('candidate.getInfo');

    Route::get('candidates/edit-profile/{id}', 'CandidateController@getEditInfoCandidate')->name('candidate.getEditInfo');

    Route::put('candidates/{id}', 'CandidateController@putEditInfoCandidate')->name('candidate.putEditInfo');
});

Route::get('/', 'HomeController@index')->name('home.index');

Route::group([
    'prefix' => 'home',
],
    function () {
        Route::get('/search', 'HomeController@search')->name('home.search');
        Route::get('/search/job', 'HomeController@searchJob')->name('home.searchJob');
    }
);

Route::group([
    'prefix' => 'jobs',
], function () {
    Route::group([
        'middleware' => [
            'auth',
            'check.company',
        ],
    ], function () {
        Route::get('/', 'JobController@index')->name('jobs.index');
        Route::get('/create', 'JobController@create')->name('jobs.create');
        Route::post('/', 'JobController@store')->name('jobs.store');
        Route::get('edit/{id}', 'JobController@edit')->name('jobs.edit');
        Route::put('update/{id}', 'JobController@update')->name('jobs.update');
        Route::delete('destroy/{id}', 'JobController@destroy')->name('jobs.destroy');
    });
    Route::get('/detail/{id}', 'JobController@show')->name('jobs.detail');
    Route::get('/apply/{id}', 'ApplicationController@create')->name('applications.create');
    Route::get('/get-jobs-by-category', 'JobController@getJobByCategory')->name('job.getJobByCategory');
});

Route::group([
    'prefix' => 'applications',
    'middleware' => [
        'auth'
    ],
], function () {
    //------------Company
    Route::group(['middleware' => 'check.company'], function () {
        Route::get('/', 'ApplicationController@index')->name('applications.index');
    });
    //------------Candidate
    Route::group(['middleware' => 'check.candidate'], function () {
        Route::get('/apply/{id}', 'ApplicationController@create')->name('applications.create');
        Route::get('/applied', 'ApplyJobController@index')->name('applyjobs.index');
        Route::post('/', 'ApplyJobController@store')->name('applyjobs.store');
    });
});


Route::group([
    'prefix' => 'client-applications',
], function () {
    Route::get('applications/get-list/{id}', 'ApplicationController@getListCandidateApplication')->name('application.getList');
    Route::get('applications/get-candidate-by-job/{id}', 'ApplicationController@getCandidateByJob')->name('ajax.getCandidateByJob');
    Route::get('applications/get-all-candidate-by-user/{id}', 'ApplicationController@getCandidateByUser')->name('ajax.getAllCandidateByUser');
});
