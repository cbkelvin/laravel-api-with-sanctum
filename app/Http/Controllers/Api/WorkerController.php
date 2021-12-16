<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{    //register api 
    public function register(Request $request)
    {
      //validation
      $request->validate([
          "name" => "required",
          "email" => "required|email|unique:workers",
          "password" => "required|confirmed",
      ]);

     //create data 
       $worker = new Worker();

       $worker->name = $request->name;
       $worker->email = $request->email;
       $worker->password = Hash::make($request->password);
       $worker->phone_no = isset($request->phone_no) ? $request->phone_no: "";

       $worker->save();
  
      //send response
      return response()->json([
          "status" => 1,
          "message" => "worker registered successfully"
      ]);
    }

    public function login(Request $request)
    {
        //validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        //check worker
        $worker = Worker::where("email", $request->email)->first();
         
        if(isset($worker->id)){
          if(Hash::check($request->password, $worker->password)){
              //create a token
              $token = $worker->createToken("auth_token")->plainTextToken;
              //send response
              return response()->json([
                  "status" => 1,
                  "message" => "worker logged in successfully",
                  "access_token" => $token
              ]);
          }else{
            return response()->json([
                "status" => 1,
                "message" => "password not matched",
            ]);
          }

        }else{
            return response()->json([
                "status" => 1,
                "message" => "worker not found"
            ]);
        }
        //create sanctum token
    }

    public function profile()
    { //profile api
      return response()->json([
          "status"=>1,
          "message"=>"worker profile information",
          "data"=>auth()->user() 
      ]);
    }
    public function logout()
    {//logout api
        auth()->user()->token()->delete();

        return response()->json([
            "status"=> 1,
            "message"=>"worker logged out successfullys"
        ]);
    }
}
