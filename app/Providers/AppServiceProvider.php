<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        $models = array(
            'Admin',
            'Application',
            'BookMark',
            'Candidate',
            'Category',
            'Company',
            'Cv',
            'Job',
            'JobCategory',
            'JobSkill',
            'JobType',
            'Location',
            'Role',
            'Skill',
            'User',
        );

        foreach ($models as $model)
        {
            $this->app->bind(
                'App\Repositories\Interfaces\\' . $model . 'Repository',
                'App\Repositories\Eloquents\Db' . $model . 'Repository'
            );
        }
    }
}
