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
      $user = Auth::user();
      $status = parcels::where('Reference', $request->Reference)->value('Status');
      $trackingNumber = parcels::where('Reference', $request->Reference)->value('Reference');
      Notification::sendNow($user, new ParcelStatus($status));

    foreach ($user->Notifications as $notification) {
       
        return response()->json([
            'success' => true,
             'data' => $notification,
             'track' => $trackingNumber,
             'status' => 200
        ]);
    }
    }

    //current loggedin user
    public function getLoggedUser(){
        $user = Auth::user();
        $id = Auth::user()->id;
        $shipped = parcels::where('user_id', $id )->where('Status', 'like', "%shipped%")->count('Status');
        $transit = parcels::where('user_id', $id )->where('Status', 'like', "%transit%")->count('Status');
        $received = parcels::where('user_id', $id )->where('Status', 'like', "%received%")->count('Status');
        $collection = parcels::where('user_id', $id )->where('Status', 'like', "%collected%")->count('Status');
        $tracking = parcels::where('user_id', $id)->get('Reference');
       

      
          
        return response()->json([
            'user' => $user,
            'shipped' => $shipped,
            'transit' => $transit,
            'received' => $received,
            'collection' => $collection,
            'track' => $tracking,
            'status' => 200
        ]);
    }

    public function notifyUser(){
   
        $user = Auth::user();
        $id = Auth::user()->id;
        $status = parcels::where('user_id', $id)->get();
      //  Notification::sendNow($user, new ParcelStatus($status));
        foreach ($user->Notifications as $notification) {
       
            return response()->json([
                 'data' => $notification,
                 'parcel' => $status,
                 'status' => 200
            ]);
        }
            

    }
    
}
