<?php

use Faker\Generator as Faker;
use App\Models\Application;
use App\Models\User;
use App\Models\Job;
use App\Models\Cv;

$factory->define(Application::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'job_id' => Job::all()->random()->id,
        'cv_url' => $faker->url,
        'status' => $faker->numberBetween(1, 3),
        'self_introduction' => $faker->text(),
    ];
});
