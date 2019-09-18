<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Instructor extends Authenticatable
{
     use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_number', 'name', 'email', 'password', 'gender', 'profile', 'birthdate', 'active'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'instructor_subjects', 'instructor_id', 'subject_id')
                    ->withPivot('block')
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

    public static function laratablesName($instructor)
    {
        return ucwords($instructor->name);
    }

    public static function laratablesGender($instructor)
    {
        return ucfirst($instructor->gender);
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\Instructor
     * @return string
     */
    public static function laratablesCustomAction($instructor)
    {
        return view('admin.instructor.includes.index_action', compact('instructor'))->render();
    }

}
