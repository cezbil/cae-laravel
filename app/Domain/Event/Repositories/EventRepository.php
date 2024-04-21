<?php

namespace App\Domain\Event\Repositories;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Repositories\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{

    public function save(Event $event): void
    {
        $event->save();
    }

    public function findById(int $id): ?Event
    {
        // TODO: Implement findById() method.
    }

    public function findByDateRange(
        \DateTimeImmutable $start,
        \DateTimeImmutable $end
    ): array {
        // TODO: Implement findByDateRange() method.
    }
}
