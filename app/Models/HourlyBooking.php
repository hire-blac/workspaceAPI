<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HourlyBooking extends Model
{
    use HasFactory;

    public function allBook(){
      return $this->belongsTo(AllBookings::class);
    }
}
