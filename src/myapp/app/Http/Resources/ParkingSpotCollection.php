<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParkingSpotCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->groupBy('row')->map(function($row) {
                return $row->map(function($spot) {
                    return [
                        'id' => $spot->id,
                        'row' => $spot->row,
                        'col' => $spot->col,
                        'spot_type' => $spot->spot_type,
                        'occupied' => $spot->occupied,
                    ];
                });
            }),
        ];
    }

}
