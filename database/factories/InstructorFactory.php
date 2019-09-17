<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Instructor;
use Faker\Generator as Faker;

$factory->define(Instructor::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
		'id_number'      => substr(date('Y'), 0 , 2) . rand(1000,9999),
		'gender'         => 'male',
		'birthdate'      =>  '2019-09-13 17:06:0',
		'password'       => '1234', // password
		'remember_token' => Str::random(10),
    ];
});
