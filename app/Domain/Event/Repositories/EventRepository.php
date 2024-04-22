<?php

namespace App\Domain\Event\Repositories;

use App\Domain\Event\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function save(Event $event): void
    {
        $event->save();
    }

    public function findById(int $id): ?Event
    {
        return Event::find($id);
    }

    public function findByDateRange(
        \DateTimeImmutable $start,
        \DateTimeImmutable $end
    ): array {
        return Event::where('date', '>=', $start->format('Y-m-d'))
            ->where('date', '<=', $end->format('Y-m-d'))
            ->get()
            ->all();
    }
}
