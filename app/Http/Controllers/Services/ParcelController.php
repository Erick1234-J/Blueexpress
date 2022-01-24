<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parcels;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{
    public function parcelSubmit(Request $request){
        $fields = $request->validate([
            'From' => 'required|string',
            'To' => 'required|string',
            'ShipDetails' => 'required|string',
            'Weight' => 'required|string',
            'Phone' => 'required|string',
            'Email' => 'required|string',
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            
            ]);
            
    
             function generatePin(){
                 $numbers = 10;
                 $pins = array();
                 for($j = 0; $j < $numbers; $j++){
                     $characters = 'ABCDEFGHIJKLMNOPQRTUVWXYZ';
    
                     //generate a pin based on 2 * 7 digits + a random character
                     $pin = mt_rand(1000000, 9999999)
                           .mt_rand(1000000, 9999999)
                           .$characters[rand(0, strlen($characters) - 1)];
    
                           $string = str_shuffle($pin);
                 }
                 return $string;   
            }
            
           
            

            $user = Auth::user()->id;
            //submit parcel 
            $parcel = parcels::create([
                'From' => $fields['From'],
                'To' => $fields['To'],
                'ShipDetails' => $fields['ShipDetails'],
                'Weight' => $fields['Weight'],
                'Phone' => $fields['Phone'],
                'Email' => $fields['Email'],
                'FirstName' => $fields['FirstName'],
                'LastName' => $fields['LastName'],
                'Reference' => generatePin(),
                'user_id' => $user
            ]);
    
           
     
            return response()->json([
                "message" => "parcel submitted successfully! visit your profile for your tracking number",
                "status" => 200
            ]);

           
    
    }
//mange user profile
   public function manage(Request $request){
      $this->validate($request, [
       'name' => 'required',
        'email' => 'required'
      ]);

     $id = Auth::user()->id;

      $profile = User::find($id);
      $profile->name = $request->input('name');
      $profile->email = $request->input('email');
      $profile->save();

      return response()->json([
        'sucess' => true,
        'message' => 'successfully updated!',
        'status' => 200
      ]);
   }


}
