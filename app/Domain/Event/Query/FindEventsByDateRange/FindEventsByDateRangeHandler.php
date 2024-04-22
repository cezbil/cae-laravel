<?php

declare(strict_types=1);

namespace App\Domain\Event\Query\FindEventsByDateRange;

use App\Domain\Event\Repositories\EventRepositoryInterface;

class FindEventsByDateRangeHandler
{
    public function __construct(private EventRepositoryInterface $repository)
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
