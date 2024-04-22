<?php

declare(strict_types=1);

namespace App\Domain\Event\Query\FindEventsByDateRange;

use App\Domain\Event\Repositories\EventRepository;

class FindEventsByDateRangeHandler
{
    public function __construct(private EventRepository $repository)
    {
    }

    public function handle(FindEventsByDateRange $query): array
    {
        return $this->repository->findByDateRange(
            $query->startDate,
            $query->endDate
        );
    }
}
