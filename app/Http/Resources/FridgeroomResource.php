<?php

namespace App\Http\Resources;

use App\Models\Block;
use Illuminate\Http\Resources\Json\JsonResource;

class FridgeroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $blocks = Block::where('is_empty', 1)
                       ->where('fridgeroom_id', $this->id)
                       ->get();

        return [
            'id' => $this->id,
            'temp' => $this->temp,
            'blocks' => BlockResource::collection($blocks)
        ];
    }
}
