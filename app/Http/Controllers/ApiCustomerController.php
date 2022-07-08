<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiCustomerController extends Controller
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
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->last_login = Carbon::now();
        $customer->save();

        Auth::login($customer);
        
        $token = $customer->createToken('Personal Access Token',['customer'])->plainTextToken;

        $response = ['message'=>'You have successfully registered', 'data'=>[
            'customer'=>$customer, 'token' => $token]];

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
          config(['auth.guards.api.provider' => 'customer']);

          $customer = Customer::firstWhere('email', $request['email']);
          
          $token = $customer->createToken('Personal Access Token',['customer'])->plainTextToken;
          
          $response = ['message'=>'Login successfull', 'data'=>[
            'customer'=>$customer, 'token' => $token]];

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