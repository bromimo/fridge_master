<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\AuthApiService;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    use AuthApiService;

    public function __invoke(LoginRequest $request)
    {
        $cred = $request->validated();

        if (!Auth::attempt($cred)) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        return $this->response(Auth::user());
    }
}
