<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParkingSpotCollection;
use App\Models\ParkingSpot;

class ParkingLotController extends Controller
{
    public function __invoke()
    {
        $parkingLot = ParkingSpot::all();

        return new ParkingSpotCollection($parkingLot);
    }
}
