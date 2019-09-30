<?php

use Illuminate\Database\Seeder;
use App\Instructor;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instructor::create([
        	'name'           => 'Mr. John Doe',
			'gender'         => 'male',
			'birthdate'      =>  '2019-09-13 17:06:0',
			'password'       => 1234,
        ]);
    }
}
