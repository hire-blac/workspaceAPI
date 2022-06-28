<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllBookings extends Model
{
    use HasFactory;

    public function houlyBookings(){
      return $this->hasMany(HourlyBooking::class);
    }
    
    public function dailyBookings(){
      return $this->hasMany(Booking::class);
    }

}
