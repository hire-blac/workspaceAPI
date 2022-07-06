<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
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

        $customer = Customer::firstWhere('email', $email);

        if(!$customer) {
          return response( array( "message" => "Email does not exist"  ), 400 );
        }
        else {
          if(password_verify($password, $customer->password)){
            $customer->last_login = Carbon::now();
            $customer->save();

            // Below the customer key passed as the second parameter sets the role
            // anyone with the auth token would have only customer access rights
            $token = $customer->createToken('Personal Access Token',['customer'])->accessToken;

            return response(array("message"=>"Sign in successful", "data"=>[
              "customer"=>$customer, "token" => $token]), 200);

          } else {
            return response( array( "message" => "Login details incorrect"  ), 400 );
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
        

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request['password']);
        $customer->last_login = Carbon::now();
        $customer->save();

        $token = $customer->createToken('Personal Access Token',['customer'])->accessToken;
        
        $response = ['message'=>'You have successfully registered', 'data'=>[
            'customer'=>$customer, 'token' => $token]];

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
    public function edit($id=1)
    {
        //
        echo "EDIT MT PROFILE";
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
