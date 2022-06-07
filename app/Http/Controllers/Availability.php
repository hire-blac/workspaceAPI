<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Space;

class Availability extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // check for avalable spaces for a day
    public function availableSpace($day, $space_type)
    {
        //
        $date = date_create($day);
        $date_string = date_format($date, 'd-m-Y');

        // get spaces of a space type
        $spaces = Space::where('space_type', $space_type)->get()->toArray();

        // get bookings for day
        $bookings = Booking::where('date', $date_string)->get();

        // loop through bookings
        foreach ($bookings as $booked) {
          for ($i=0; $i < count($spaces); $i++) { 

            // check if space has been booked for that day
            if ($spaces[$i]['space_name'] == $booked->space->space_name) {
              unset($spaces[$i]);
              $spaces = array_values($spaces);
            }
          }
        }
        
        return $spaces;
    }

}
