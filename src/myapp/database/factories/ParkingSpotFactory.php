<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingSpot>
 */
class ParkingSpotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plate_number' => null,
            'spot_type' => $this->faker->randomElement(['regular', 'motorcycle']),
            'occupied' => rand(0, 1),
            'row' => $this->faker->numberBetween(1, 10),
            'col' => $this->faker->numberBetween(1, 10),
        ];
    }

    /**
     * Indicate that the spot is occupied.
     */
    public function occupied(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'occupied' => 1,
                //random plate number
                'plate_number' => $this->faker->unique()->randomNumber(6),
            ];
        });
    }

    /**
     * Indicate that the spot is not occupied.
     */
    public function unoccupied(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'occupied' => 0,
            ];
        });
    }

    /**
     * Indicate that the spot is a regular spot.
     */
    public function regular(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'spot_type' => 'regular',
            ];
        });
    }

    /**
     * Indicate that the spot is a motorcycle spot.
     */
    public function motorcycle(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'spot_type' => 'motorcycle',
            ];
        });
    }
}
