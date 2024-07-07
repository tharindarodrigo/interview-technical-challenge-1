<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkRequest;
use App\Models\ParkingSpot;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class ParkingSpotController extends Controller
{
    public function park(ParkRequest $parkRequest, int $id)
    {
        $parkingSpot = ParkingSpot::findOrFail($id);

        if ($parkingSpot->canPark($parkRequest->vehicle_type)) {
            if ($parkingSpot->park($parkRequest->vehicle_type) !== false) {

                Cache::forget('parking_lot');

                return response()->json(['message' => "{$parkRequest->vehicle_type} parked successfully"]);
            }
        }

        return response()->json(['message' => 'Cannot park vehicle'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function unpark(int $id)
    {
        $parkingSpot = ParkingSpot::findOrFail($id);

        if ($parkingSpot->occupied) {
            $parkingSpot->unpark();

            Cache::forget('parking_lot');

            return response()->json(['message' => 'Parking spot is now vacant']);
        }

        return response()->json(['message' => 'Parking spot is already vacant'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
