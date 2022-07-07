<?php

namespace App\Http\Services;

class Booking
{
    private static int $block_length        = 2000;
    private static int $block_width         = 1000;
    private static int $block_height        = 1000;
    private static int $temp_deviation_high = 2;
    private static int $temp_deviation_low  = 2;
    private static int $temp_limit_high     = 0;

    private static float $block_day_price = 10.00;

    private function __construct()
    {

    }

    public static function getBlocksCount(int $volume): int
    {
        $length = env('API_BLOCK_SIZE_LENGTH', self::$block_length);
        $length = is_numeric($length) ? $length : self::$block_length;

        $width = env('API_BLOCK_SIZE_WIDTH', self::$block_width);
        $width = is_numeric($width) ? $width : self::$block_width;

        $height = env('API_BLOCK_SIZE_HEIGHT', self::$block_height);
        $height = is_numeric($height) ? $height : self::$block_height;

        return ceil($volume / floor($length / 1000 * $width / 1000 * $height / 1000));
    }

    public static function getBlockDayPrice(): float
    {
        $block_day_price = env('API_BOOKING_BLOCK_DAY_PRICE', self::$block_day_price);

        return is_numeric($block_day_price) ? $block_day_price : self::$block_day_price;
    }

    public static function getTempDeviationHigh(): int
    {
        $temp_deviation_high = env('API_BOOKING_TEMP_DEVIATION_HIGH', self::$temp_deviation_high);

        return is_numeric($temp_deviation_high) ? $temp_deviation_high : self::$temp_deviation_high;
    }

    public static function getTempDeviationLow(): int
    {
        $temp_deviation_low = env('API_BOOKING_TEMP_DEVIATION_LOW', self::$temp_deviation_low);

        return is_numeric($temp_deviation_low) ? $temp_deviation_low : self::$temp_deviation_low;
    }

    public static function getTempLimitHigh(): int
    {
        $temp_limit_high = env('API_BOOKING_TEMP_LIMIT_HIGH', self::$temp_limit_high);

        return is_numeric($temp_limit_high) ? $temp_limit_high : self::$temp_limit_high;
    }
}