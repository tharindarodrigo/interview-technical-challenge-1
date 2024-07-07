<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingSpot;

class ParkingLotController extends Controller
{
    public function __invoke()
    {
        $parkingLot = ParkingSpot::query()->get();

        //group the parking spots by rows
        $parkingSpotRows = $parkingLot->groupBy('row');

        // return $parkingRows;
        return response()->json($parkingSpotRows);
    }
}
