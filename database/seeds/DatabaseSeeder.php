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
        factory('App\Course', 4)->create();
    	factory('App\Admin')->create();
    	factory('App\Student')->create();
        factory('App\Instructor', 10)->create();
    }
}
