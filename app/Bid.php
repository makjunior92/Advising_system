<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    //
      protected $fillable = [
        'offer_id', 'student_id', 'bid',
    ];


    public function student() {
    	return $this->belongsTo('App\Student');
    }


    public function offeredcourse() {
    	return $this->belongsTo('App\OfferedCourse','offer_id');
    }
}
