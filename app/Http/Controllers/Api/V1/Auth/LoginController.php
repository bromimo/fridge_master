<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Services\AuthApiServece;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    use AuthApiServece;

    public function __invoke(LoginRequest $request)
    {
        $cred = $request->validated();

        if (!Auth::attempt($cred)) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        return $this->response(Auth::user());
    }
}
