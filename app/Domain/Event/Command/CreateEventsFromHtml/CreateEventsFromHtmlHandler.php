<?php

declare(strict_types=1);

namespace App\Domain\Event\Command\CreateEventsFromHtml;

use App\Domain\Bus\Command\CommandHandler;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Repositories\EventRepository;

class CreateEventsFromHtmlHandler extends CommandHandler
{
    public function __construct(private EventRepository $eventRepository) {}

    public function handle(CreateEventsFromHtml $command): void
    {
        //TODO: handle
    }
}
