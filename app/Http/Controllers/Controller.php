<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected int $block_value;

    private int $block_length = 2000;
    private int $block_width  = 1000;
    private int $block_height = 1000;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $length = env('API_BLOCK_SIZE_LENGTH', $this->block_length);
        $length = is_numeric($length) ? $length : $this->block_length;

        $width = env('API_BLOCK_SIZE_WIDTH', $this->block_width);
        $width = is_numeric($width) ? $width : $this->block_width;

        $height = env('API_BLOCK_SIZE_HEIGHT', $this->block_height);
        $height = is_numeric($height) ? $height : $this->block_height;

        $this->block_value = floor($length / 1000 * $width / 1000 * $height / 1000);
    }
}
