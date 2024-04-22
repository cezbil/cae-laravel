<?php

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Query\GetEventsByDateRangeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\FindEventsByDateRangeRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\QueryParam;

#[Authenticated]
#[QueryParam("startDate", "string", "The start date", required: true, example: '2024-04-22T13:43:11')]
#[QueryParam("endDate", "string", "The start date", required: true, example: '2024-04-22T13:43:11')]
class FindEventsByDateRangeController extends Controller
{
    public function __construct(
        private readonly GetEventsByDateRangeService $getEventsByDateRangeService
    ) {
    }
    public function __invoke(
        FindEventsByDateRangeRequest $request
    ): JsonResponse {
        $validatedData = $request->validated();

        return response()->json($this->getEventsByDateRangeService->getEventsByDateRange($validatedData));
    }
}
