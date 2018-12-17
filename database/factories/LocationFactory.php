<?php

use Faker\Generator as Faker;
use App\Models\Location;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
    ];
});
