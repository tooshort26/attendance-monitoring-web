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
    	factory('App\Student')->create();
    	factory('App\Admin')->create();
        // $this->call(UsersTableSeeder::class);
    }
}
