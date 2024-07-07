<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkRequest;
use App\Models\ParkingSpot;
use Illuminate\Http\Response;

class ParkingSpotController extends Controller
{
    public function park(ParkRequest $parkRequest, int $id)
    {
        $parkingSpot = ParkingSpot::query()->findOrFail($id);

        if ($parkingSpot->canPark($parkRequest->vehicle_type)) {
            if ($parkingSpot->park($parkRequest->vehicle_type) !== false) {
                return response()->json(['message' => "{$parkRequest->vehicle_type} parked successfully"]);
            }
        }

        return response()->json(['message' => 'Cannot park vehicle'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function unpark(int $id)
    {
        $parkingSpot = ParkingSpot::query()->findOrFail($id);

        if ($parkingSpot->occupied) {
            $parkingSpot->unpark();

            return response()->json(['message' => 'Parking spot is now vacant']);
        } else {
            return response()->json(['message' => 'Parking spot is already vacant'], 422);
        }
    }
}
