<?php

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
        factory('App\Student', 20)->create();
        $this->call([
            AdminSeeder::class,
            InstructorSeeder::class,
            // StudentSeeder::class,
            DepartmentSeeder::class,
            CourseSeeder::class,
        ]);
    }
}
