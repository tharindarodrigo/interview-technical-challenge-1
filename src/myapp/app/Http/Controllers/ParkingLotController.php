<?php

namespace App\Http\Controllers;

use App\Models\ParkingSpot;

class ParkingLotController extends Controller
{
    public function __invoke()
    {
        $parkingSpotRows = ParkingSpot::query()
            ->orderBy('row')
            ->orderBy('col')
            ->get()
            ->groupBy('row');

        return view('parking-lot', compact('parkingSpotRows'));
    }
}
