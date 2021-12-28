<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     //register function for new user

   public function registerUser(Request $request){
    $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email',
        'password'=> 'required|string',
        'password_confirmation' => 'required|same:password'
    ]);

    if(!$fields){
        return response()->json(['status' => 'failed', 'message' => 'validation_errors', 'errors' => $fields->errors()]);
    }

    

    $userData = array(
        'name' => $fields['name'],
        'email'=> $fields['email'],
        'password' => bcrypt($fields['password'])
    );

    $user = User::create($userData);

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
        'success' => true,
        'status' => 200,
      'message' => 'Registration submitted successfully',
      'token' => $token
    ];

    return response()->json($response);

 }
 

 //login new user
 public function loginUser(Request $request){
     $fields = $request->validate([
         'email' => 'required|string|',
         'password'=> 'required|string|'
     ]);

     //check email
     $user = User::where('email', $fields['email'])->first();

     //check password

     if(!$user || !Hash::check($fields['password'], $user->password)){
        return response([
            'message' => 'bad credentials! try again',
            'success' => false,
            'status' => 401
        ]);
    }
    
     $token = $user->createToken('myapptoken')->plainTextToken;


     $response = [
         'success' => true,
         'status' => 200,
         'message' => 'Successfully logged in',
         'token' => $token
       ];

       return response()->json($response);
     }
     //logout user
 public function logoutUser(){

    auth()->user()->tokens()->delete();
     
    return [
        'message' => 'logged out!'
    ];
  }
}
