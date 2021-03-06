<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HourlyBooking;
use App\Models\Booking;
use App\Models\DailyHours;
use App\Models\Space;
use App\Models\AllBookings;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;


class HourlyBookinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
      
      if (Auth::user() instanceOf Staff) {
          return $id ? HourlyBooking::find($id) : HourlyBooking::all();
      } else {
          if($id){
            $booking = HourlyBooking::find($id);
            return $booking->user_id == Auth::user()->id ? $booking : ["message" => "Unauthorized access"];
          }
          return ["message" => "Restricted access"];
      }
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
      $start_hour = DailyHours::firstWhere('start', $request->start_time);

      $numhours = $request->num_hours ? $request->num_hours : 1 ;

      $total_hours = $start_hour->start + $numhours;

      $allBooking = new AllBookings();
      $allBooking->booking_type = "hourly";
      $allBooking->save();

      $bookings = [];

      if ($total_hours > 17) {
        return ["response"=>"Allowed hours exceeded"];
      } else {

        $weekday = date_format($date, 'l');
        $date_string = date_format($date, 'd-m-Y');
  
        // Validate booking doesnt already exist
        if ($weekday == "Saturday" or $weekday == "Sunday") {
            return ["response"=>"Booking must be on a weekday"];
        } else {
          for ($i=$start_hour->start; $i < $total_hours; $i++) { 
            $hour = DailyHours::firstWhere('start', $i);

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
            else { // all good

              $hourbooking = new HourlyBooking;
              $hourbooking->space_id = $request->space_id;
              $hourbooking->week_day = $weekday;
              $hourbooking->date = $date_string;
              $hourbooking->hour = $hour->id;
              $hourbooking->user_id = $request->user();

              $allBooking->houlyBookings()->save($hourbooking);
              $allBooking->refresh();
        
              $response = $hourbooking->save();

              array_push($bookings, $hourbooking);
            }
          }
        }
  
      }

      return $response ? ["message"=>"Hourly booking saved", "data"=>$bookings] : ["response"=>"error occured"];
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
