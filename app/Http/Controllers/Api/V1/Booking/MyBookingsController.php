<?php

namespace App\Http\Controllers\Api\V1\Booking;

use JetBrains\PhpStorm\ArrayShape;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyBookingsController extends Controller
{
    #[ArrayShape([
        'name'  => "mixed",
        'email' => "mixed",
        'books' => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection"
    ])]
    public function __invoke(): array
    {
        return (new BookingsController)->__invoke(Auth::user()->id);
    }
}
