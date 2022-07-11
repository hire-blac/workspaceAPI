<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Space;
use App\Models\AllBookings;

class WeeklyBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $response = array();

        $space = Space::find($request->space_id);
  
        $date = date_create($request->start_date);

        if (date_format($date, 'l') == "Saturday" or date_format($date, 'l') == "Sunday") {
          return ["response"=>"Booking must be on a weekday"];
        }
        else { //start_date is not a weekend
          $a = 1;
          $daysArray = array();
          array_push($daysArray, $date);

          while ($a < 5) {
            // get the next day
            $nextDay = date("d-m-Y",strtotime(date_format($date, 'd-m-Y').'+1 day'));
            
            //check if day is a weekend
            if (date('N', strtotime($nextDay)) >= 6) {

              // create new date object
              $newDate = date_create($nextDay);

              // assign new date to date
              $date = $newDate;

              // continue while loop without incrementing loop counter
              continue;
            }
            else { //date is not a weekend
              // create new date object
              $newDate = date_create($nextDay);

              // assign new date to date
              $date = $newDate;
              // push date to days array and increase loop counter
              array_push($daysArray, $newDate);
              $a += 1;
            }
          }

          $allBooking = new AllBookings();
          $allBooking->booking_type = "weekly";
          $allBooking->save();

          foreach ($daysArray as $day) {
            $weekday = date_format($day, 'l');
            $date_string = date_format($day, 'd-m-Y');
            
            $space = Space::find($request->space_id);
            // $booked = Booking::where('space_id',$request->space_id)
            // ->where('date',$date_string)->first();

            // if ($booked) {
            //     return ["response"=>"worksapce already booked for that day"];
            // } 
            // else {
            //     $booking = new Booking;
            //     $booking->space_id = $request->space_id;
            //     $booking->week_day = $weekday;
            //     $booking->date = $date_string;
            //     $response = $booking->save();
            // }

            $booking = new Booking;
            $booking->space_id = $request->space_id;
            $booking->week_day = $weekday;
            $booking->date = $date_string;
            $booking->user_id = $request->user();
            
            $allBooking->dailyBookings()->save($booking);
            $allBooking->refresh();

            // $res = $booking->space()->save($space);
            $res = $booking->save();
            $arr = $res ? ['response' => $space->space_name.' booked on '.$weekday.' '.$date_string] : ["response"=>"error occured"];
            array_push($response, $arr);
          }
        }

        return $response;
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
    }
}
