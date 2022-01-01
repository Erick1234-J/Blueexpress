<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\ParcelController;
use App\Http\Controllers\Services\TrackingController;
use App\Http\Controllers\Services\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'loginUser']);




Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::post('/submit_parcels', [ParcelController::class, 'parcelSubmit']);
    Route::post('/track_number', [TrackingController::class, 'CheckStatus']);  
    Route::get('/user', [TrackingController::class, 'getLoggedUser']);
    Route::get('/notification', [TrackingController::class, 'notifyUser']);
});

/*
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
*/