<?php

use Illuminate\Database\Seeder;
use App\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
			'name'          => 'Bachelor of Science in Education',
			'abbr'          => 'BSED',
			'department_id' => 1
        ]);

        Course::create([
			'name' => 'Bachelor of Science in Information Tech',
			'abbr' => 'BSIT',
			'department_id' => 2
        ]);

        Course::create([
			'name' => 'Bachelor of Science in Information System',
			'abbr' => 'BSIS',
			'department_id' => 2
        ]);

        Course::create([
			'name' => 'Bachelor of Science in Computer Science',
			'abbr' => 'BSCS',
			'department_id' => 2
        ]);

        Course::create([
			'name' => 'Hotel and Restaurant Management',
			'abbr' => 'HRM',
			'department_id' => 2
        ]);

        Course::create([
			'name' => 'Associate Computer Technology',
			'abbr' => 'ACT',
			'department_id' => 2
        ]);

        Course::create([
			'name' => 'Bachelor of Science in Crimonology',
			'abbr' => 'BSCrim',
			'department_id' => 3,
        ]);



    }
}
