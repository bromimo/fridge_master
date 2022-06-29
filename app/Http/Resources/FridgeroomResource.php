<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Block;
use Illuminate\Http\Resources\Json\JsonResource;

class FridgeroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = (Carbon::now())->format('Y-m-d');

        $blocks = Block::where('fridgeroom_id', $this->id)
                       ->whereDoesntHave('orders', function ($query) use ($date) {
                           $query->whereDate('booking_at', '<=', $date)
                                 ->whereDate('booking_to', '>=', $date);
                       })
                       ->get();

        return [
            'id'     => $this->id,
            'temp'   => $this->temp,
            'blocks' => BlockResource::collection($blocks)
        ];
    }
}
