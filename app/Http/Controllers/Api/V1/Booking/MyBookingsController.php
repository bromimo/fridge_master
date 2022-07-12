<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyBookingsController extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        return (new BookingsController)->__invoke(Auth::user()->id);
    }
}
