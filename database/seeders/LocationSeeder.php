<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [
                'title' => 'Уилмингтон (Северная Каролина)',
                'utc'   => '-4'
            ],
            [
                'title' => 'Портленд (Орегон)',
                'utc'   => '-7'
            ],
            [
                'title' => 'Торонто',
                'utc'   => '-4'
            ],
            [
                'title' => 'Варшава',
                'utc'   => '+2'
            ],
            [
                'title' => 'Валенсия',
                'utc'   => '+2'
            ],
            [
                'title' => 'Шанхай',
                'utc'   => '+8'
            ]
        ];

        foreach ($seeds as $seed) {
            Location::create($seed);
        }
    }
}
