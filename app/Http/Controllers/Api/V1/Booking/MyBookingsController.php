<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyBookingsController extends Controller
{
    public function __invoke(): array
    {
        return (new BookingsController)(Auth::user()->id);
    }
}
