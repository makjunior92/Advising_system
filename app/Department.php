<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    public function faculties(){
    	return $this->hasMany('App\Faculty', 'dept_id');
    }

    public function courses(){
    	return $this->hasMany('App\Faculty', 'dept_id');	
    }


    public function hod() {
    	return $this->hasOne('App\Faculty');
    }
}
