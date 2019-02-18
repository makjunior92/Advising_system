<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferedCourse extends Model
{
    //

	public function course(){
		return $this->belongsTo('App\Course');
	}

	public function faculty() {
    	return $this->belongsTo('App\Faculty'); 
    }

	public function department(){
		return $this->belongsTo('App\Department', 'dept_id');
	}




}
