<?php

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Query\GetEventsByDateRangeService;
use App\Domain\Event\Services\Query\GetFlightsService;
use App\Domain\Event\Services\Query\GetStandByService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaeRequest;
use App\Http\Requests\Event\FindEventsByDateRangeRequest;
use Illuminate\Http\JsonResponse;

class FindStandByForNextWeekController extends Controller
{
    public function __construct(
        private readonly GetStandByService $standByService
    ) {
    }
    public function __invoke(
        CaeRequest $request
    ): JsonResponse {
        return response()->json($this->standByService->getStandByForNextWeek());
    }
}

