<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Web')->group(function () {
    Route::get('', \App\Http\Controllers\Web\IndexController::class);
    Route::prefix('auth')->namespace('Auth')->group(function () {
        Route::post('login', \App\Http\Controllers\Web\Auth\LoginController::class)->name('login');
//        Route::post('register', \App\Http\Controllers\Api\V1\Auth\RegisterController::class);
//        Route::middleware('auth:sanctum')->group(function () {
//            Route::get('logout', \App\Http\Controllers\Api\V1\Auth\LogoutController::class);
//        });
    });
});


