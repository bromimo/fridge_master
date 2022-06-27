<?php

namespace App\Http\Resources;

use App\Models\Block;
use App\Http\Services\BookingServise;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckResource extends JsonResource
{
    public BookingServise $booking;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->booking = new BookingServise($request->temp, $request->volume);

        $blocks = Block::where('is_empty', 1)
                       ->whereIn('fridgeroom_id', function ($query) {
                           $query->select('id')
                                 ->from('fridgerooms')
                                 ->where('location_id', $this->id)
                                 ->where('temp', '<=', $this->booking->temp + $this->booking->temp_deviation_high)
                                 ->where('temp', '>=', $this->booking->temp - $this->booking->temp_deviation_low)
                                 ->where('temp', '<=', $this->booking->temp_limit_high);
                       })
                       ->limit($this->booking->cnt)
                       ->get();

        $cnt = count($blocks);

        if ($cnt < $this->booking->cnt)
            return [
                'error'    => true,
                'message'  => 'The required number of blocks is missing',
                'required' => $this->booking->cnt,
                'exists'   => $cnt
            ];

        return [
            'location' => $this->title,
            'blocks'   => CheckBlockResource::collection($blocks)
        ];
    }
}
