<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;

class IndexController extends Controller
{
    public function __invoke()
    {
        $locations = Location::has('fridgerooms')->get();

        return LocationResource::collection($locations);
    }
}
