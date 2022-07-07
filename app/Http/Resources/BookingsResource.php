<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Services\Booking;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'id'         => $this->id,
            'status'     => $this->status(),
            'location'   => $this->blocks[0]->fridgeroom->location->title,
            'temp'       => $this->blocks[0]->fridgeroom->temp,
            'blocks'     => count($this->blocks),
            'booking_at' => $this->booking_at,
            'booking_to' => $this->booking_to,
            'term'       => $this->term(),
            'expenses'   => $this->expenses(),
            'access_key' => $this->access_key,
        ];
    }

    private function status(): string
    {
        return new Carbon($this->booking_to) < new Carbon() ? 'finished' : 'actual';
    }

    private function term(): int
    {
        $booking_at = new Carbon($this->booking_at);
        $booking_to = new Carbon($this->booking_to);

        return $booking_to->diffInDays($booking_at);
    }

    private function expenses(): float
    {
        return count($this->blocks) * Booking::getBlockDayPrice() * $this->term();
    }
}
