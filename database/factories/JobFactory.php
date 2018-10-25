<?php

use Faker\Generator as Faker;
use App\Models\Job;
use App\Models\User;
use App\Models\JobType;
use App\Models\Location;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'title' => $faker->text(15),
        'salary_min' => $faker->numberBetween(3000000, 4000000),
        'salary_max' => $faker ->numberBetween(10000000, 20000000),
        'description' => $faker->text(200),
        'job_type_id' => JobType::all()->random()->id,
        'location_id' => Location::all()->random()->id,
        'experience' => $faker->text(250),
        'out_date' => $faker->dateTime,
    ];
});
