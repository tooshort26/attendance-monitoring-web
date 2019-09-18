<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description', 'level', 'semester'];

    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_subjects', 'subject_id', 'student_id')
                    ->withPivot('remarks')
                    ->withTimestamps();
    }

    public function instructors()
    {
        return $this->belongsToMany('App\Instructor', 'instructor_subjects', 'subject_id', 'instructor_id')
                    ->withPivot('block')
                    ->withTimestamps();
    }
}
