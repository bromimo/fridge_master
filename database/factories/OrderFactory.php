<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = Carbon::now()->subMonth()->addDays(rand(1,15));

        return [
            'user_id' => rand(1, 10),
            'booking_at' => $date->format('Y-m-d'),
            'booking_to' => $date->addDays(rand(5,20))->format('Y-m-d'),
            'access_key' => $this->faker->bothify('************')
        ];
    }
}
