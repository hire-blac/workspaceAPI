<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function signIn(Request $request)
    {
        //
        $email = $request->input('email');
        $password = $request->input('password');

        $rules = [
            'email' => 'required|email:rfc, dns|max:255',
            'password' => ['required'],
        ];

        // $validator = Validator::make($request->all(), $rules,$this->validationMessages());

        // if ($validator->fails()) {
        //   return  response()->json(["message" => $validator->errors()->first()],400);
        // }

        $staff = Staff::firstWhere('email', $email);

        if(!$staff) {
          return response( array( "message" => "Email does not exist"  ), 400 );
        }
        else {
          if(password_verify($password, $staff->password)){
            $staff->last_login = Carbon::now();
            $staff->save();

            // Below the staff key passed as the second parameter sets the role
            // anyone with the auth token would have only staff access rights
            $token = $staff->createToken('Personal Access Token',['staff'])->accessToken;

            return response(array("message"=>"Sign in successful", "data"=>[
              "staff"=>$staff, "token" => $token]), 200);

          } else {
            return response( array( "message" => "Login credentials incorrect"  ), 400 );
          }
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response(array('message'=>'You have been successfully logged out'), 200);
    }

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
    public function register(Request $request)
    {
      // $validator = Validator::make($request->all(), [
      //   'name' => 'required|string|max:255',
      //   'email' => 'required|string|email|max:255|unique:users',
      //   'password' => 'required|string|min:6|confirmed',
      // ]);

      // if ($validator->fails())
      // {
      //     return response(['errors'=>$validator->errors()->all()], 422);
      // }

      // $request['password']=Hash::make($request['password']);
      $request['remember_token'] = Str::random(10);
      

      
      $staff = new Staff();
      $staff->name = $request->name;
      $staff->email = $request->email;
      $staff->password = Hash::make($request['password']);
      $staff->last_login = Carbon::now();
      $staff->save();

      $token = $staff->createToken('Personal Access Token',['staff'])->accessToken;
      
      $response = ['message'=>'You have successfully registered', 'data'=>[
          'staff'=>$staff, 'token' => $token]];

      return response($response, 200);
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
