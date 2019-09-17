<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
        	'name' => 'Education Dept.'
        ]);

        Department::create([
        	'name' => 'ITE/TVET Dept.'
        ]);

        Department::create([
        	'name' => 'Criminology Dept.'
        ]);
    }
}
