<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description', 'level', 'semester'];

    public function subjects()
    {
        return $this->belongsToMany('App\Student', 'student_subjects', 'subject_id', 'student_id')
                    ->withPivot('remarks')
                    ->withTimestamps();
    }
}
