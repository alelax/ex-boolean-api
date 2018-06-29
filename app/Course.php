<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function teacher()
    {
        return $this->belongTo('App\Teacher');
    }
}
