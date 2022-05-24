<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    public function bookings(){
      return $this->hasMany(Booking::class);
    }

    public function spaceType(){
      return $this->belongsTo(SpaceType::class);
    }
}
