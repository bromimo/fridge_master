<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\CheckResource;
use App\Http\Requests\Booking\CheckRequest;

class CheckController extends Controller
{
    public function __invoke(CheckRequest $request)
    {
        $request->validated();

        $location = Location::where('id', $request->location_id)->get();

        return CheckResource::collection($location);
    }
}
