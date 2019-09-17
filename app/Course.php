<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'abbr'];

    public function student()
    {
    	return $this->hasOne('App\Student');
    }

    public function department()
    {
    	return $this->belongsTo('App\Department');
    }
}
