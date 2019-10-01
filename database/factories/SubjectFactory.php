<?php

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
		'name'        => $faker->name,
		'description' => $faker->sentence,
		'level'       => $faker->numberBetween(1, 5),
		'semester'    => $faker->numberBetween(1, 3),
		'credits'     => $faker->numberBetween(1, 3)
    ];
});
