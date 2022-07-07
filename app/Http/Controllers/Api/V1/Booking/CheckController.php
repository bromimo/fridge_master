<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Http\Services\CheckService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\CheckRequest;

class CheckController extends Controller
{
    use CheckService;

    public function __invoke(CheckRequest $request)
    {
        return $this->checkAvailableBlocks($request->validated());
    }
}
