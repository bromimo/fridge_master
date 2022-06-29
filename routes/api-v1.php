<?php

use Illuminate\Http\Request;
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

Route::post('login', \App\Http\Controllers\Api\V1\Auth\LoginController::class);

Route::prefix('booking')->namespace('Booking')->group(function () {
    Route::get('', \App\Http\Controllers\Api\V1\Booking\IndexController::class);
    Route::post('check', \App\Http\Controllers\Api\V1\Booking\CheckController::class);
});

