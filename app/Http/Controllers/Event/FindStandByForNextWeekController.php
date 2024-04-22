<?php

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Query\GetStandByService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaeRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;

#[Authenticated]
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

