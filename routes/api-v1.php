<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::post('login', \App\Http\Controllers\Api\V1\Auth\LoginController::class);
    Route::post('register', \App\Http\Controllers\Api\V1\Auth\RegisterController::class);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', \App\Http\Controllers\Api\V1\Auth\LogoutController::class);
    });
});

Route::prefix('booking')->namespace('Booking')->middleware('auth:sanctum')->group(function () {
    Route::get('', \App\Http\Controllers\Api\V1\Booking\IndexController::class);
    Route::post('check', \App\Http\Controllers\Api\V1\Booking\CheckController::class);
    Route::post('book', \App\Http\Controllers\Api\V1\Booking\BookController::class);
});

