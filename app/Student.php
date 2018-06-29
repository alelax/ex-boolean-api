<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{   
    protected $fillable = ["name", "surname", "age", "address", "gender", "course_id"];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
