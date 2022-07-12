<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Models\User;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingsResource;

class BookingsController extends Controller
{
    public function __invoke($id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);

        $orders = Order::where('user_id', $user->id)
                       ->get();

        return response()->json([
            'data' => [
                'name'  => $user->name,
                'email' => $user->email,
                'books' => BookingsResource::collection($orders)
            ]
        ], 200);
    }
}
