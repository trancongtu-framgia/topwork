<?php

use Faker\Generator as Faker;
use App\Models\Candidate;
use App\Models\User;

$factory->define(Candidate::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'dob' => $faker->dateTime,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'avatar_url' => $faker->url,
        'description' => $faker->text(15),
        'facebook' => $faker->url,
        'youtube' => $faker->url,
        'twitter' => $faker->url,
        'experience' => $faker->text(200),
    ];
});
