<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Student extends Authenticatable
{
     use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_number', 'name', 'password', 'gender', 'profile', 'birthdate', 'course_id', 'level'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'student_subjects', 'student_id', 'subject_id')
                    ->withPivot('remarks')
                    ->withTimestamps();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getBirthdateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public static function laratablesName($student)
    {
        return ucwords($student->name);
    }

    public static function laratablesGender($student)
    {
        return ucfirst($student->gender);
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Student
     * @return string
     */
    public static function laratablesCustomAction($student)
    {
        return view('admin.student.includes.index_action', compact('student'))->render();
    }
}
