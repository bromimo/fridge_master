<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\Block;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

trait BookService
{
    public function saveNewOrder(array $data): \Illuminate\Http\JsonResponse|array
    {
        if (!$this->isBlocksEmpty($data))
            return response()->json([
                'message' => 'The order is invalid.',
                'errors'  => 'There are blocks here that are busy.'
            ], 422);

        $order = new Order([
            'user_id'    => Auth::user()->id,
            'booking_at' => $data['booking_at'],
            'booking_to' => $data['booking_to'],
            'access_key' => Str::random(12)
        ]);

        $order->save();

        $order->blocks()->attach($data['blocks']);

        return [
            'block_cnt'  => count($data['blocks']),
            'booking_at' => $order['booking_at'],
            'booking_to' => $order['booking_to'],
            'access_key' => $order['access_key']
        ];
    }

    public function isBlocksEmpty(array $data): bool
    {
        $blocks = Block::select('blocks.id')
                       ->leftJoin('block_order', 'block_order.block_id', '=', 'blocks.id')
                       ->leftJoin('orders', 'orders.id', '=', 'block_order.order_id')
                       ->where(function ($query) use ($data) {
                           $query->whereDate('booking_at', '>=', $data['booking_at'])
                                 ->whereDate('booking_to', '<=', $data['booking_to']);
                       })
                       ->orWhere(function ($query) use ($data) {
                           $query->whereDate('booking_at', '<=', $data['booking_at'])
                                 ->whereDate('booking_to', '<=', $data['booking_to'])
                                 ->whereDate('booking_to', '>', $data['booking_at']);
                       })
                       ->orWhere(function ($query) use ($data) {
                           $query->whereDate('booking_at', '>=', $data['booking_at'])
                                 ->whereDate('booking_to', '>=', $data['booking_to'])
                                 ->whereDate('booking_at', '<', $data['booking_to']);
                       })
                       ->orWhere(function ($query) use ($data) {
                           $query->whereDate('booking_at', '<=', $data['booking_at'])
                                 ->whereDate('booking_to', '>=', $data['booking_to']);
                       })
                       ->get();

        $busy_blocks = [];
        foreach ($blocks as $block) {
            $busy_blocks[] = $block['id'];
        }

        if (array_intersect($data['blocks'], $busy_blocks)) {
            return false;
        }

        return true;
    }
}