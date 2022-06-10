<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HourlyBooking;
use App\Models\Booking;
use App\Models\DailyHours;
use App\Models\Space;

class HourlyBookinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
      return $id ? HourlyBooking::find($id) : HourlyBooking::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $date = date_create($request->date);
      $hour = DailyHours::firstWhere('hour', $request->start_time);

      $weekday = date_format($date, 'l');
      $date_string = date_format($date, 'd-m-Y');

      // Validate booking doesnt already exist
      if ($weekday == "Saturday" or $weekday == "Sunday") {
          return ["response"=>"Booking must be on a weekday"];
      } else {
        // find day booking
        $dayBooked = Booking::where('space_id',$request->space_id)
            ->where('date',$date_string)->first();
        
        // find hour booking
        $hourBooked = HourlyBooking::where('space_id',$request->space_id)
            ->where('date',$date_string)
            ->where('hour',$hour->id)->first();
        
        if ($dayBooked or $hourBooked) {
            return ["response"=>"worksapce already booked for that day and time"];
        } 
        else {
          $hourbooking = new HourlyBooking;
          $hourbooking->space_id = $request->space_id;
          $hourbooking->week_day = $weekday;
          $hourbooking->date = $date_string;
          $hourbooking->hour = $hour->id;
    
          $response = $hourbooking->save();
        }
      }

      return $response ? ["response"=>"object saved"] : ["response"=>"error occured"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

      return ["booo"=>"show"];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      return ["booo"=>"edit"];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      return ["booo"=>"update"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      return ["booo"=>"destroy"];
    }
}
