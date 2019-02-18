<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollCourse extends Model
{
    //

     protected $fillable = [
        'offcourse_id', 'student_id', 'bid_id',
    ];
    public function student() {
    	return $this->belongsTo('App\Student');
    }


    public function offeredcourse() {
    	return $this->belongsTo('App\OfferedCourse','offcourse_id');
    }

    public function bid() {
    	return $this->belongsTo('App\Bid');
    }

}
