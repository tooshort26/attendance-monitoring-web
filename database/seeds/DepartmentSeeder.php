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
        $departments = ['Education', 'ITE/TVET', 'Criminology', 'BSA/BSBA'];
        
        foreach ($departments as $department) {
            Department::create([
                'name' => $department
            ]);    
        }
        

    }
}
