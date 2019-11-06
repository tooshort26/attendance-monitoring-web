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
        factory(Instructor::class, 10)->create();
    }
}
