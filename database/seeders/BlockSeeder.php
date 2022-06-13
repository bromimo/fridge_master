<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Fridgeroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Block::factory(100)->create();
    }
}
