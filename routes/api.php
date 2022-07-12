<?php

use App\Http\Controllers\ApiCustomerController;
use App\Http\Controllers\ApiStaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceTypeController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\HourlyBookinController;
use App\Http\Controllers\Availability;
use App\Http\Controllers\DailyHoursController;
use App\Http\Controllers\WeeklyBookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['cors', 'json'])->group(function(){

  // Customer Routes
  Route::group(['prefix'=>'customer'],function(){
    // unauthenticated customer routes here
    Route::post("register", [ApiCustomerController::class, 'register']);
    Route::post("login", [ApiCustomerController::class, 'login']);

    Route::group(['middleware'=> ['auth:sanctum']], function(){
      //authenticated customer routes here
      Route::post("logout", [ApiCustomerController::class, 'logout']);
      Route::get("me", [ApiCustomerController::class, 'me']);

      // booking routes
      Route::get("hourly-booking/{id}", [HourlyBookinController::class, "index"]);
      Route::put("hourly-booking/{id}/update", [HourlyBookinController::class, "update"]);
      Route::delete("hourly-booking/{id}/delete", [HourlyBookinController::class, "destroy"]);
      
      Route::post("weekly-booking/new", [WeeklyBookingController::class, "store"]);
      Route::post("hourly-booking/new", [HourlyBookinController::class, "store"]);
      
      Route::post("bookings/new", [BookingsController::class, "store"]);
      Route::get("bookings/{id}", [BookingsController::class, "index"]);
      Route::delete("bookings/{id}/delete", [BookingsController::class, "destroy"]);

    });
  });

  // Staff Routes
  Route::group(['prefix'=>'staff'],function(){
    // unauthenticated staff routes here
    Route::post("register", [ApiStaffController::class, 'register']);
    Route::post("login", [ApiStaffController::class, 'login']);

    Route::group(['middleware'=> ['auth:sanctum']], function(){
      //authenticated staff routes here
      Route::post("logout", [ApiStaffController::class, 'logout']);
      Route::get("me", [ApiStaffController::class, 'me']);

      // booking routes
      Route::get("hourly-booking/{id?}", [HourlyBookinController::class, "index"]);
      Route::delete("hourly-booking/{id}/delete", [HourlyBookinController::class, "destroy"]);
      
      Route::get("bookings/{id?}", [BookingsController::class, "index"]);
      Route::delete("bookings/{id}/delete", [BookingsController::class, "destroy"]);

      Route::post("space-type/new", [SpaceTypeController::class, "store"]);
      Route::put("space-type/{id}/update", [SpaceTypeController::class, "update"]);
      Route::delete("space-type/{id}/delete", [SpaceTypeController::class, "destroy"]);
      
      Route::post("space/new", [SpaceController::class, "store"]);
      Route::put("space/{id}/update", [SpaceController::class, "update"]);
      Route::delete("space/{id}/delete", [SpaceController::class, "destroy"]);

    });
  });


  Route::get("dailyhours/{id?}", [DailyHoursController::class, "index"]);
  Route::post("dailyhours/new", [DailyHoursController::class, "store"]);
  
  Route::get("bookings/day-bookings/{day?}", [BookingsController::class, "day_bookings"]);
  Route::get("bookings/day-bookings/{day}/available", [BookingsController::class, "available_space"]);
  
  Route::get("available/{day}", [Availability::class, "hourlyAvailableSpace"]);
  Route::get("available/{day}/{space_type}", [Availability::class, "availableSpace"]);

  Route::get("space/{id?}", [SpaceController::class, "index"]);

  Route::get("space-type/{id?}", [SpaceTypeController::class, "index"]);
  
});
