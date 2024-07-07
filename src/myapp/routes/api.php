<?php

use App\Http\Controllers\Api\ParkingLotController;
use App\Http\Controllers\Api\ParkingSpotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//parking lot
Route::get('/parking-lot', ParkingLotController::class);

//park
Route::post('/parking-spot/{id}/park', [ParkingSpotController::class, 'park']);

//unpark
Route::post('/parking-spot/{id}/unpark', [ParkingSpotController::class, 'unpark']);
