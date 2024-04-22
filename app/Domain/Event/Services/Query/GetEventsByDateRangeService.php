<?php

namespace App\Domain\Event\Services\Query;

use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;

class GetEventsByDateRangeService
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    /**
     * @throws \Exception
     */
    public function getEventsByDateRange(array $dateRange): array
    {
        $query = new FindEventsByDateRange(
            new \DateTimeImmutable($dateRange["startDate"]),
            new \DateTimeImmutable($dateRange["endDate"]),
        );
        return $this->queryBus->ask($query);
    }
}
