<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Fridgeroom;
use Illuminate\Database\Seeder;

class FridgeroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = Location::all();
        foreach ($locations as $location) {
            Fridgeroom::factory(rand(5, 20))->create(['location_id' => $location->id]);
        }

    }
}
