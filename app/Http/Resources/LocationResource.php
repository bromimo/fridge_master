<?php

namespace App\Http\Resources;

use App\Models\Fridgeroom;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $fridgerooms = Fridgeroom::has('blocks')
                                 ->where('location_id', $this->id)
                                 ->get();

        return [
            'location' => $this->title,
            'fridgerooms' => FridgeroomResource::collection($fridgerooms)
        ];
    }
}
