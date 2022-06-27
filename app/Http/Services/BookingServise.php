<?php

namespace App\Http\Services;

class BookingServise
{
    private int $block_length = 2000;
    private int $block_width  = 1000;
    private int $block_height = 1000;

    private int $block_volume;

    public int $temp_deviation_high = 2;
    public int $temp_deviation_low  = 2;
    public int $temp_limit_high     = 0;

    public int $temp;
    public int $cnt;

    public function __construct(int $temp, int $volume)
    {
        $this->init();
        $this->temp = $temp;
        $this->cnt = ceil($volume / $this->block_volume);
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
    }
}