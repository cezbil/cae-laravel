<?php

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Query\GetEventsByDateRangeService;
use App\Domain\Event\Services\Query\GetFlightsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaeRequest;
use App\Http\Requests\Event\FindEventsByDateRangeRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;

#[Authenticated]
class FindFlightsForNextWeekController extends Controller
{
    public function __construct(
        private readonly GetFlightsService $flightsService
    ) {
    }
    public function __invoke(
        CaeRequest $request
    ): JsonResponse {
        return response()->json($this->flightsService->getFlightsNextWeek());
    }
}

