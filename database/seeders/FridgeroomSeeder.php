<?php

namespace Database\Seeders;

use App\Models\Fridgeroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Fridgeroom::factory(10)->create();
    }
}
