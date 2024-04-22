<?php

declare(strict_types=1);

namespace App\Domain\Event\Command\CreateEventsFromHtml;

use App\Domain\Bus\Command\Command;
use App\Domain\Event\Models\Event;

/**
 *
 */
class CreateEventsFromHtml extends Command
{
    /**
     * @param  array<Event>  $events
     */
    public function __construct(
        public array $events,
    ) {
    }

    /**
     * @return Event[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @param  array  $events
     *
     * @return void
     */
    public function setEvents(array $events): void
    {
        $this->events = $events;
    }
}
