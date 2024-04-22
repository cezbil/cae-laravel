<?php

declare(strict_types=1);

namespace App\Http\Controllers\Event;

use App\Domain\Event\Services\Command\CreateEventsFromHtmlService;
use App\Domain\Event\Services\Command\Interfaces\HtmlEventParserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\CreateEventsFromHtmlRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Authenticated;

#[Authenticated]
class CreateEventsFromHtmlController extends Controller
{
    public function __construct(
        private readonly CreateEventsFromHtmlService $createEventsFromHtmlService,
        private readonly HtmlEventParserInterface $htmlEventParser
    ) {
    }

    public function __invoke(
        CreateEventsFromHtmlRequest $request
    ): JsonResponse {
        $validatedDataFile = $request->validated()['html_file'];

        $parsedData = $this->htmlEventParser->parse($validatedDataFile);
        $this->createEventsFromHtmlService->createEvents($parsedData);

        return response()->json([
            'message' => 'Events successfully created',
            'success' => true,
        ]);
    }
}
