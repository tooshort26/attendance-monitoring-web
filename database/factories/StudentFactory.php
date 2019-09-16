<?php

use App\Student;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Student::class, function (Faker $faker) {
    return [
		'name'           => $faker->name,
		'id_number'      => substr(date('Y'), 0 , 2) . rand(1000,9999),
		// 'id_number'   => '1501756',
		'level'          => 1,
		'gender'         => 'male',
		'birthdate'      =>  '2019-09-13 17:06:0',
		'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
		'remember_token' => Str::random(10),
		'course_id'      => 1,
    ];
});


