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
            'firstname'     => 'Firstname',
            'middlename'    => 'Middlename',
            'lastname'      => 'Lastname',
            'gender'        => 'male',
            'birthdate'     =>  '2019-09-13 17:06:0',
            'password'      => 1234,
            'email'         => 'christophervistal25@gmail.com',
            'status'        => 'full-time',
            'contact_no'    => '09193693499',
            'department_id' => 1,
        ]);
    }
}
