<?php
declare(strict_types=1);

namespace App\Domain\Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\CreateEventsFromHtml\CreateEventsFromHtml;

class CreateEventsFromHtmlService
{
    public function __construct(private readonly CommandBus $commandBus) {}

    public function createEvents(array $events): void
    {
        $createEventsCommand = new CreateEventsFromHtml(
            $events
        );

        $this->commandBus->dispatch($createEventsCommand);
    }
}
