<?php

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Command\CreateEventService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\CreateEventRequest;

class CreateEventController extends Controller
{
    public function __construct(private CreateEventService $createEventService) {

    }

    public function __invoke(
        CreateEventRequest $request
    ) {
        $validatedData = $request->validated();

        $this->createEventService->createEvent($validatedData);

        return response()->json([
            'message' => 'Event successfully created',
            'success' => true,
        ]);
    }
}
