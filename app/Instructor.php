<?php

namespace App;

use App\Instructor;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
   protected $fillable = ['id_number', 'name', 'email'];

    public static function boot()
    {
        parent::boot();
        self::creating(function(Instructor $instructor) {
            $instructorCount = Instructor::count();
            $instructor->id_number = date('Y') . ++$instructorCount;
            return true;
        });
    }
}
