<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Fridgeroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fridgeroom_id' => Fridgeroom::inRandomOrder()->first()->id,
            'is_empty' => $this->faker->boolean(30)
        ];
    }
}
