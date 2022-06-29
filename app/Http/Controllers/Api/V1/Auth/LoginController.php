<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])
                    ->where('password', hash('sha256', $data['password']))
                    ->get();

        return $user;
    }
}
