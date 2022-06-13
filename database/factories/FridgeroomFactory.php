<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fridgeroom>
 */
class FridgeroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'location_id' => Location::inRandomOrder()->first()->id,
            'temp' => '-' . $this->faker->numberBetween(1, 32)
        ];
    }
}
