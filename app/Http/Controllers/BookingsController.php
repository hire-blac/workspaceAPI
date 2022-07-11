<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Space;
use App\Models\AllBookings;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;


class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {

      if (Auth::user() instanceOf Staff) {
          return $id ? Booking::find($id) : Booking::all();
      } else {
          if($id){
            $booking = Booking::find($id);
            return $booking->user_id == Auth::user()->id ? $booking : ["message" => "Unauthorized access"];
          }
          return ["message" => "Restricted access"];
      }
    }

    // show all the bookings for a single day
    public function day_bookings($date)
    {
      $date = date_create($date);
      $date_string = date_format($date, 'd-m-Y');

      return Booking::where('date', $date_string)->get();
    }

    // show all the available work spaces for a single day
    public function available_space($date)
    {
      $date = date_create($date);
      $date_string = date_format($date, 'd-m-Y');

      $spaces = Space::all()->toArray();
      $bookings = Booking::where('date', $date_string)->get();

      foreach ($bookings as $booked) {
        for ($i=0; $i < count($spaces); $i++) { 
          if ($spaces[$i]['space_name'] == $booked->space->space_name) {
            unset($spaces[$i]);
            $spaces = array_values($spaces);
            break;
          }
        }
      }
      return $spaces;
    }

    // Create a new booking
    public function store(Request $request)
    {
        // convert date string to array
        $dateArray = explode(",", $request->date);

        $space = Space::find($request->space_id);

        $allBooking = new AllBookings();
        $allBooking->booking_type = "daily";
        $allBooking->user_id = $request->user();
        $allBooking->save();

        $bookings = [];

        // loop through array elements and create date objects
        foreach ($dateArray as $day) {
          $date = date_create($day);

          $weekday = date_format($date, 'l');
          $date_string = date_format($date, 'd-m-Y');

          // Validate booking doesnt already exist
          if ($weekday == "Saturday" or $weekday == "Sunday") {
              return ["response"=>"Booking must be on a weekday"];
          } 
          else {
              $booked = Booking::where('space_id',$request->space_id)
              ->where('date',$date_string)->first();

              if ($booked) {
                  return ["response"=>"worksapce already booked for that day"];
              } 
              else {

                $booking = new Booking;
                $booking->space_id = $request->space_id;
                $booking->week_day = $weekday;
                $booking->date = $date_string;
                $booking->user_id = $request->user();

                $allBooking->dailyBookings()->save($booking);
                $allBooking->refresh();

                $response = $booking->save();

                array_push($bookings, $booking);
              }
          }
        }

        return $response ? ["message"=>"booking saved", "data"=>$bookings] : ["response"=>"error occured"];
    }

    // Delete Booking
    public function destroy(Request $request, $id)
    {

        $booking = Booking::find($id);

        if($request->user()->id == $booking->user_id) {
          $booking->delete();
          $response = ["response"=>"object deleted"];
        }
        $response = ["message"=>"You do not have permission to delete this object"];

        return $response;
    }
}
