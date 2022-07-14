<?php

namespace App\Http\Controllers\Api\V1\Booking;

use App\Models\User;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingsResource;

class BookingsController extends Controller
{
    public function __invoke($id): array
    {
        $user = User::find($id);

        if (is_null($user)) {
            return [
                'message' => 'Non-existen user ID.',
                'errors' => [
                    'id' => 'Non-existen user ID.'
                ]
            ];
        }

        $orders = Order::where('user_id', $user->id)
                       ->get();

        return [
            'data' => [
                'name'  => $user->name,
                'email' => $user->email,
                'books' => BookingsResource::collection($orders)
            ]
        ];
    }
}
