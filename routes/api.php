<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpaceTypeController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\BookingsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'api', 'middleware'=>'cors']);

Route::get("space-type/{id?}", [SpaceTypeController::class, "index"]);
Route::post("space-type/new", [SpaceTypeController::class, "store"]);
Route::put("space-type/{id}/update", [SpaceTypeController::class, "update"]);
Route::delete("space-type/{id}/delete", [SpaceTypeController::class, "destroy"]);

Route::get("space/{id?}", [SpaceController::class, "index"]);
Route::post("space/new", [SpaceController::class, "store"]);
Route::put("space/{id}/update", [SpaceController::class, "update"]);
Route::delete("space/{id}/delete", [SpaceController::class, "destroy"]);

Route::get("bookings/{id?}", [BookingsController::class, "index"]);
Route::get("bookings/day-bookings/{day}", [BookingsController::class, "day_bookings"]);
Route::get("bookings/day-bookings/{day}/available", [BookingsController::class, "available_space"]);
Route::post("bookings/new", [BookingsController::class, "store"]);
Route::delete("bookings/{id}/delete", [BookingsController::class, "destroy"]);
