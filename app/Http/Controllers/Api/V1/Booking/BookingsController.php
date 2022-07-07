<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Models\User;
use App\Models\Order;
use JetBrains\PhpStorm\ArrayShape;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingsResource;

class BookingsController extends Controller
{
    #[ArrayShape([
        'name'  => "mixed",
        'email' => "mixed",
        'books' => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection"
    ])]
    public function __invoke($id): array
    {
        $user = User::find($id);

        $orders = Order::where('user_id', $user->id)
                       ->get();

        return [
            'name'  => $user->name,
            'email' => $user->email,
            'books' => BookingsResource::collection($orders)
        ];
    }
}
