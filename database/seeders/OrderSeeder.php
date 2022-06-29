<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Block;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::factory(10)->create();
        $blocks = Block::all();

        foreach ($orders as $order) {
            $blocksId = $blocks->random(rand(1, 20))->pluck('id');
            $order->blocks()->attach($blocksId);
        }
    }
}
