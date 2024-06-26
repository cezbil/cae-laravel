<?php

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Query\GetFlightsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\FindFlightsByStartLocationRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\QueryParam;

#[Authenticated]
#[QueryParam("startLocation", "string", "The start location", required: true)]
class FindFlightsByStartLocationController extends Controller
{
    public function __construct(
        private readonly GetFlightsService $flightsService
    ) {
    }
    public function __invoke(
        FindFlightsByStartLocationRequest $request
    ): JsonResponse {
        $validatedData = $request->validated();

        return response()->json($this->flightsService->getFlightsFromStartLocation($validatedData['startLocation']));
    }
}
