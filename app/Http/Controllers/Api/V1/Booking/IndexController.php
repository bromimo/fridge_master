<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;

class IndexController extends Controller
{
    public function __invoke()
    {
        $locations = Location::all();

        return LocationResource::collection($locations);
    }
}
