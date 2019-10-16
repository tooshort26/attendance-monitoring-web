<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Subject::create([
			'name'          => 'SS1 1',
			'description'   => 'Sample Subject 1',
			'level'         => 1,
			'credits'       => 3,
			'semester'      => 1,
			'school_year'   => '2019-2020',
			'department_id' => 1,
		]);

		Subject::create([
			'name'        => 'SS1 2',
			'description' => 'Sample Subject 2',
			'level'       => 1,
			'credits'     => 3,
			'semester'    => 2,
			'school_year' => '2019-2020',
			'department_id' => 1,
		]);

		Subject::create([
			'name'        => 'SS1 3',
			'description' => 'Sample Subject 3',
			'level'       => 1,
			'credits'     => 3,
			'semester'    => 3,
			'school_year' => '2019-2020',
			'department_id' => 3,
		]);
    }
}
