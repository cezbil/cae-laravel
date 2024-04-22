<?php

use App\Http\Controllers\Event\CreateEventController;
use App\Http\Controllers\Event\CreateEventsFromHtmlController;
use App\Http\Controllers\Event\FindEventsByDateRangeController;
use App\Http\Controllers\Event\FindFlightsForNextWeekController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/events')->group(function () {
    Route::post('/', [CreateEventController::class, '__invoke'])->name('events.create');
    Route::post('/import', [CreateEventsFromHtmlController::class, '__invoke'])->name('events.import');
    Route::get('/range', [FindEventsByDateRangeController::class, '__invoke'])->name('events.range');
    Route::get('/flights', [FindFlightsForNextWeekController::class, '__invoke'])->name('flights.nextweek');
});
Route::prefix('/auth')->group(function () {
    Route::post('/register', [UserRegisterController::class, '__invoke']);
    Route::post('/login', [UserLoginController::class, '__invoke'])->name('login');
});
