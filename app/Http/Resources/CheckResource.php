<?php

namespace App\Http\Resources;

use App\Models\Block;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckResource extends JsonResource
{
    protected int $temp_deviation_high = 2;
    protected int $temp_deviation_low  = 2;
    protected int $temp_limit_high     = 0;

    protected int $temp;

    public function __construct($resource)
    {
        $this->init();
        parent::__construct($resource);
    }

    protected function init()
    {
        $temp_deviation_high = env('API_BOOKING_TEMP_DEVIATION_HIGH', $this->temp_deviation_high);
        $this->temp_deviation_high = is_numeric($temp_deviation_high) ? $temp_deviation_high : $this->temp_deviation_high;

        $temp_deviation_low = env('API_BOOKING_TEMP_DEVIATION_LOW', $this->temp_deviation_low);
        $this->temp_deviation_low = is_numeric($temp_deviation_low) ? $temp_deviation_low : $this->temp_deviation_low;

        $temp_limit_high = env('API_BOOKING_TEMP_LIMIT_HIGH', $this->temp_limit_high);
        $this->temp_limit_high = is_numeric($temp_limit_high) ? $temp_limit_high : $this->temp_limit_high;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->temp = $request->temp;

        $blocks = Block::where('is_empty', 1)
                       ->whereIn('fridgeroom_id', function ($query) {
                           $query->select('id')
                                 ->from('fridgerooms')
                                 ->where('location_id', $this->id)
                                 ->where('temp', '<=', $this->temp + $this->temp_deviation_high)
                                 ->where('temp', '>=', $this->temp - $this->temp_deviation_low)
                                 ->where('temp', '<=', $this->temp_limit_high);
                       })
                       ->get();

        $result = [
            'location' => $this->title,
            'blocks'   => CheckBlockResource::collection($blocks)
        ];

        return $result;
    }
}
