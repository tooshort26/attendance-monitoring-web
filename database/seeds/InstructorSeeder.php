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
			/*'id_number'      => substr(date('Y'), 0 , 2) . rand(1000,9999),*/
            'id_number'      => 1501755,
			'gender'         => 'male',
			'birthdate'      =>  '2019-09-13 17:06:0',
			'password'       => 1234,
        ]);
    }
}
