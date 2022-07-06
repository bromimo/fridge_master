<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Http\Services\BookService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookRequest;

class BookController extends Controller
{
    use BookService;

    public function __invoke(BookRequest $request)
    {
        $order = $this->saveNewOrder($this->validated($request));

        return $order;
    }
}
