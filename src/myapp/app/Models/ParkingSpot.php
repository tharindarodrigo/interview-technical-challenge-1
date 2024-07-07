<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder vacantSpotsForVan($row, $col)
 */
class ParkingSpot extends Model
{
    use HasFactory;

    protected $fillable = ['row', 'col', 'spot_type', 'occupied', 'plate_number'];

    public function canPark(string $vehicleType): bool
    {
        if ($vehicleType === 'motorcycle') {
            return ! $this->occupied;
        }

        if ($vehicleType === 'car') {
            return ! $this->occupied && $this->spot_type === 'regular';
        }

        if ($vehicleType === 'van') {
            return $this->canParkVan();
        }

        return false;
    }

    private function canParkVan(): bool
    {
        $regularVacantSpots = ParkingSpot::vacantSpotsForVan($this->row, $this->col)->count();

        return $regularVacantSpots === 3;
    }

    public function park(string $vehicleType): bool
    {
        if ($vehicleType === 'motorcycle' || $vehicleType === 'car') {
            return $this->update(['occupied' => 1]);
        }

        if ($vehicleType === 'van') {
            return $this->parkVan();
        }

        throw new \Exception('Invalid vehicle type');
    }

    private function parkVan(): bool
    {
        $vanSpots = ParkingSpot::vacantSpotsForVan($this->row, $this->col);

        if ($vanSpots->count() === 3) {
            return $vanSpots->update(['occupied' => 2]);
        }

        return false;
    }

    public function unpark(): bool
    {
        if ($this->occupied == 1) { // motorcycle or car
            return $this->update(['occupied' => 0]);
        }

        if ($this->occupied == 2) { // van
            // chunk the row into chunks of 3 to find the vans parked
            ParkingSpot::where('row', $this->row)
                ->where('occupied', 2)
                ->chunk(3, function ($vans) {
                    // check if the van is parked includes one of the spots
                    if ($vans->where('col', $this->col)->count() == 1) {
                        return ParkingSpot::whereIn('id', $vans->pluck('id'))
                            ->update(['occupied' => 0]);
                    }
                });
        }

        return false;
    }

    public function scopeVacantSpotsForVan(Builder $query, int $row, int $col): void
    {
        $query->where('row', $row)
            ->where('col', '>=', $col)
            ->where('col', '<', $col + 3)
            ->where('spot_type', 'regular')
            ->where('occupied', 0);
    }
}
