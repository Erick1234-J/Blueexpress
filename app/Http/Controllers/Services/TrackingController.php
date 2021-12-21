<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Parcels;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ParcelStatus;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function CheckStatus(Request $request){
      $request->validate([
          'Reference' => 'required|string'
      ]);
      $user = User::first();
      $status = parcels::where('Reference', $request->Reference)->value('Status');
      Notification::sendNow($user, new ParcelStatus($status));

      foreach ($user->Notifications as $notification) {
       
        return response()->json([
             'data' => $notification,
            "status" => 200
        ]);
    }
        
    }

    //current loggedin user
    public function getLoggedUser(){
        $user = Auth::user();

        return response()->json([
            'user' => $user,
            'status' => 200
        ]);
    }
    //number of parcels
    public function getParcelCount(){
        $id = Auth::user()->id;
        $parcels = parcels::where('user_id', $id)->count('Status');

        return response()->json([
           'data' => $parcels,
           'status' => 200
        ]);

    }
}
