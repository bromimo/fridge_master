<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Block;
use App\Models\Location;

trait CheckService
{
    public function checkAvailableBlocks(array $data): array
    {
        $location = Location::find($data['location_id']);

        $blocks = Block::select('blocks.id')
                       ->leftJoin('fridgerooms', 'fridgerooms.id', '=', 'blocks.fridgeroom_id')
                       ->leftJoin('locations', 'locations.id', '=', 'fridgerooms.location_id')
                       ->where('locations.id', $location->id)
                       ->where('fridgerooms.temp', '<=', $data['temp'] + Booking::getTempDeviationHigh())
                       ->where('fridgerooms.temp', '>=', $data['temp'] - Booking::getTempDeviationLow())
                       ->where('fridgerooms.temp', '<=', Booking::getTempLimitHigh())
                       ->whereNotIn('blocks.id', function ($query) use ($data) {
                           $query->select('blocks.id')
                                 ->from('blocks')
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
                                 });
                       })
                       ->limit(Booking::getBlocksCount($data['volume']))
                       ->get();

        $booking_at = new Carbon($data['booking_at']);
        $booking_to = new Carbon($data['booking_to']);

        $term = $booking_to->diffInDays($booking_at);

        $cnt = count($blocks);

        $blocks_list = [];
        foreach ($blocks as $block) {
            $blocks_list[] = $block['id'];
        }

        return [
            'location' => $location->title,
            'count'    => $cnt,
            'term'     => $term,
            'price'    => $cnt * Booking::getBlockDayPrice() * $term,
            'order'    => [
                'blocks'     => $blocks_list,
                'booking_at' => $data['booking_at'],
                'booking_to' => $data['booking_to']
            ]
        ];
    }
}