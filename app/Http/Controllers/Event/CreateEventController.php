<?php

declare(strict_types=1);

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Command\CreateEventService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\CreateEventRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;

#[Authenticated]
class CreateEventController extends Controller
{
    public function __construct(private readonly CreateEventService $createEventService)
    {
    }

    public function __invoke(
        CreateEventRequest $request
    ): JsonResponse {
        $validatedData = $request->validated();

        $this->createEventService->createEvent($validatedData);

        return response()->json([
            'message' => 'Event successfully created',
            'success' => true,
        ]);
    }
}
