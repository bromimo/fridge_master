<?php

namespace App\Services;

use Illuminate\Support\Str;

trait AuthApiService
{
    public function response($user)
    {
        $token = $user->createToken(Str::random(40))->plainTextToken;

        return response()->json([
            'user'       => $user,
            'token'      => $token,
            'token_type' => 'Bearer'
        ]);
    }
}