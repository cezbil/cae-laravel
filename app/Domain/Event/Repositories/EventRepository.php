<?php

namespace App\Domain\Event\Repositories;

use App\Domain\Event\Models\Event;
use Carbon\Carbon;

class EventRepository implements EventRepositoryInterface
{
    public const START_DATE = '14-01-2022';

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

    public function findFlightsNextWeek(): array
    {
        $currentDate = new Carbon(self::START_DATE);
        $nextWeekStart = $currentDate->copy()->addWeek();
        $nextWeekEnd = $nextWeekStart->copy()->endOfWeek();

        $events = Event::where('date', '>=', $nextWeekStart->format('Y-m-d'))
            ->where('date', '<=', $nextWeekEnd->format('Y-m-d'))
            ->get();

        $filteredEvents = $events->filter(function ($event) {
            return preg_match('/^[A-Z]{2}\d+$/', $event->activity);
        });

        return $filteredEvents->all();
    }
}
