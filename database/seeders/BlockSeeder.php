<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Fridgeroom;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fridgerooms = Fridgeroom::all();
        foreach ($fridgerooms as $fridgeroom) {
            Block::factory(rand(20, 100))->create(['fridgeroom_id' => $fridgeroom->id]);
        }
    }
}
