<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParkingSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = 10;

        for ($i = 1; $i <= $rows; $i++) {
            $columns = 20;
            for ($j = 1; $j <= $columns; $j++) {
                \App\Models\ParkingSpot::factory()
                    ->unoccupied()
                    // ->regular()
                    ->create([
                        'row' => $i,
                        'col' => $j,
                    ]);
            }
        }
    }
}
