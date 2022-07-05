<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Booking\BookRequest;

class BookController extends Controller
{
    public function __invoke(BookRequest $request)
    {
        $json = $request->validated();

        $validator = Validator::make(json_decode($json['order'], true), [
            'blocks' => ['required', 'array'],
            'booking_at' => ['required', 'date_format:Y-m-d'],
            'booking_to' => ['required', 'date_format:Y-m-d']
        ]);

        $errors = $validator->errors();

        if ($errors->messages()) return [
            'message' => 'The order is invalid',
            'errors' => $errors
        ];

        $order = $validator->validated();

        return $order;
    }
}
