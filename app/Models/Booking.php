<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function space(){
      return $this->belongsTo(Space::class);
    }

    // public function dayOfMonth(){
    //   return $this->belongsTo('App\Models\DayOfMonth');
    // }

    public function workDay(){
      return $this->belongsTo(WorkDay::class);
    }
}
