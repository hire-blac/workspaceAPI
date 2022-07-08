<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiStaffController extends Controller
{
  public function register(Request $request)
  {
    // Validate request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required',
    ]);
    // Return errors if validation error occur.
    if ($validator->fails()) {
        $errors = $validator->errors();
        return response()->json(['error' => $errors], 400);

    } else {
        $staff = new Staff();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->last_login = Carbon::now();
        $staff->save();

        Auth::user($staff);
        
        $token = $staff->createToken('Personal Access Token',['staff'])->plainTextToken;

        $response = ['message'=>'You have successfully registered', 'data'=>[
            'staff'=>$staff, 'token' => $token]];

        return response($response, 200);
    }
  }

  public function login(Request $request)
  {
      $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
      ]);

      if (Auth::attempt($credentials)) {
          config(['auth.guards.api.provider' => 'staff']);

          $staff = Staff::firstWhere('email', $request['email']);
          
          $token = $staff->createToken('Personal Access Token',['staff'])->plainTextToken;
          
          $response = ['message'=>'Login successfull', 'data'=>[
            'staff'=>$staff, 'token' => $token]];

          return response($response, 200);
      }

      return response()->json([
          'message' => 'Invalid login details'
      ], 401);

  }

  public function me(Request $request)
  {
      return $request->user();
  }
}