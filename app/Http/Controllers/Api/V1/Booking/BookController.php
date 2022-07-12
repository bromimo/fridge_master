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
        return $this->saveNewOrder($request->validated()['order']);
    }
}
