<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Block;
use App\Models\Location;
use App\Http\Resources\BlockResource;
use App\Http\Resources\CheckBlockResource;

class BookingServise
{
    private int $block_length = 2000;
    private int $block_width  = 1000;
    private int $block_height = 1000;

    private int $block_volume;

    private float $block_day_price = 10.00;

    public int $temp_deviation_high = 2;
    public int $temp_deviation_low  = 2;
    public int $temp_limit_high     = 0;

    public int $temp;
    public int $cnt;

    public array $data;

    public function __construct(array $data)
    {
        $this->init();
        $this->data = $data;
        $this->cnt = ceil($this->data['volume'] / $this->block_volume);
    }

    private function init(): void
    {
        $length = env('API_BLOCK_SIZE_LENGTH', $this->block_length);
        $length = is_numeric($length) ? $length : $this->block_length;

        $width = env('API_BLOCK_SIZE_WIDTH', $this->block_width);
        $width = is_numeric($width) ? $width : $this->block_width;

        $height = env('API_BLOCK_SIZE_HEIGHT', $this->block_height);
        $height = is_numeric($height) ? $height : $this->block_height;

        $this->block_volume = floor($length / 1000 * $width / 1000 * $height / 1000);

        $temp_deviation_high = env('API_BOOKING_TEMP_DEVIATION_HIGH', $this->temp_deviation_high);
        $this->temp_deviation_high = is_numeric($temp_deviation_high) ? $temp_deviation_high : $this->temp_deviation_high;

        $temp_deviation_low = env('API_BOOKING_TEMP_DEVIATION_LOW', $this->temp_deviation_low);
        $this->temp_deviation_low = is_numeric($temp_deviation_low) ? $temp_deviation_low : $this->temp_deviation_low;

        $temp_limit_high = env('API_BOOKING_TEMP_LIMIT_HIGH', $this->temp_limit_high);
        $this->temp_limit_high = is_numeric($temp_limit_high) ? $temp_limit_high : $this->temp_limit_high;

        $block_day_price = env('API_BOOKING_BLOCK_DAY_PRICE', $this->block_day_price);
        $this->block_day_price = is_numeric($block_day_price) ? $block_day_price : $this->block_day_price;
    }

    public function check()
    {
        $location = Location::find($this->data['location_id']);

        $blocks = Block::whereIn('fridgeroom_id', function ($query) use ($location) {
            $query->select('id')
                  ->from('fridgerooms')
                  ->where('location_id', $location->id)
                  ->where('temp', '<=', $this->data['temp'] + $this->temp_deviation_high)
                  ->where('temp', '>=', $this->data['temp'] - $this->temp_deviation_low)
                  ->where('temp', '<=', $this->temp_limit_high);
        })
                       ->whereDoesntHave('orders', function ($query) {
                           $query->whereDate('booking_at', '>=', $this->data['booking_at'])
                                 ->whereDate('booking_to', '<=', $this->data['booking_to']);
                       })
                       ->limit($this->cnt)
                       ->get();

        $cnt = count($blocks);

        if ($cnt < $this->cnt)
            return [
                'message'  => 'The required number of blocks is missing',
                'required' => $this->cnt,
                'exists'   => $cnt
            ];

        $booking_at = new Carbon($this->data['booking_at']);
        $booking_to = new Carbon($this->data['booking_to']);

        $term = $booking_to->diffInDays($booking_at);

        $price = $cnt * $this->block_day_price * $term;

        $blocks_list = [];
        foreach ($blocks as $block) {
            $blocks_list[] = $block['id'];
        }

        return [
            'location' => $location->title,
            'count'    => $cnt,
            'term'     => $term,
            'price'    => $price,
            'order'    => json_encode([
                'blocks'     => $blocks_list,
                'booking_at' => $this->data['booking_at'],
                'booking_to' => $this->data['booking_to']
            ])
        ];
    }
}