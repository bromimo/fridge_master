<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Http\Controllers\Controller;
use App\Http\Services\BookingServise;
use App\Http\Requests\Booking\CheckRequest;

class CheckController extends Controller
{
    public function __invoke(CheckRequest $request)
    {
        $data = $request->validated();

        $booking = new BookingServise($data);

        return $booking->check();
    }
}
