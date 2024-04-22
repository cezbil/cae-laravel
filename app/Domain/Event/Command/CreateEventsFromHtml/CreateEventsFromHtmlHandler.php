<?php

declare(strict_types=1);

namespace App\Domain\Event\Command\CreateEventsFromHtml;

use App\Domain\Bus\Command\CommandHandler;
use App\Domain\Event\Repositories\EventRepository;

class CreateEventsFromHtmlHandler extends CommandHandler
{
    public function __construct(private EventRepository $eventRepository)
    {
    }

    public function handle(CreateEventsFromHtml $command): void
    {
        foreach ($command->getEvents() as $eventData) {
            $this->eventRepository->save($eventData);
        }
    }
}
