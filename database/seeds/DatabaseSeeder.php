<?php

use App\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory('App\Student', 39)->create();
        // factory('App\Subject', 8)->create();
        // factory('App\Subject', 20)->create();
        // factory('App\Instructor', 5)->create();
        $this->call([
            AdminSeeder::class,
            InstructorSeeder::class,
            // StudentSeeder::class,
            DepartmentSeeder::class,
            CourseSeeder::class,
            SubjectSeeder::class,
        ]);
        
        /*Subject::all()->each(function ($subject) {
            $subject->students()->attach(1, ['instructor_id' => 1, 'remarks' => 1]);
        });*/
    }
}
