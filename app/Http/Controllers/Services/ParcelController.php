<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parcels;
use App\Models\User;
use App\Mail\TrackingNumber;
use Illuminate\Support\Facades\Mail;
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
            
           
            //$user = User::first();
            //access current logged in user  User::where('email', $fields['Email'])->value('id');

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
    
            Mail::to($request->Email)->send(new TrackingNumber($parcel));
     
            return response()->json([
                "message" => "successfully submitted!",
                "status" => 200
            ]);

           
    
    }


}
