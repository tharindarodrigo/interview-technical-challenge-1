<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParkingSpotCollection;
use App\Models\ParkingSpot;
use Illuminate\Support\Facades\Cache;

class ParkingLotController extends Controller
{
    public function __invoke()
    {
        $parkingLot = $parkingLot = Cache::remember('parking_lot', 60, function () {
            return ParkingSpot::all();
        });

        return new ParkingSpotCollection($parkingLot);
    }
}
