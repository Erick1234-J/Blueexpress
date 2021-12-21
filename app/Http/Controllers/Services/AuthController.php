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

    

    $user = User::create([
        'name' => $fields['name'],
        'email'=> $fields['email'],
        'password' => bcrypt($fields['password'])
    ]);

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
        'success' => true,
      'user' => $user,
      'token' => $token
    ];

    return response()->json($response, 201);

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
             'message' => 'bad credentials! try again'
         ], 401);
     }

     $token = $user->createToken('myapptoken')->plainTextToken;


     $response = [
         'user' => $user,
         'token' => $token
       ];

       return response()->json($response, 201);
     }
     //logout user
 public function logoutUser(){

    auth()->user()->tokens()->delete();
     
    return [
        'message' => 'logged out!'
    ];
  }
}
