<?php

use App\Http\Controllers\Event\CreateEventController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/events')->group(function () {
    Route::post('/create', [CreateEventController::class, '__invoke']);
});
Route::prefix('/auth')->group(function () {
    Route::post('/register', [UserRegisterController::class, '__invoke']);
    Route::post('/login', [UserLoginController::class, '__invoke'])->name('login');
});
