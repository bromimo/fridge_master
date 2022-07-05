<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Services\AuthApiService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    use AuthApiService;

    public function __invoke(RegisterRequest $request)
    {
        $date = $request->validated();

        $user = User::create([
            'name' => ucwords($date['name']),
            'email' => $date['email'],
            'password' => bcrypt($date['password'])
        ]);

        return $this->response($user);
    }
}
