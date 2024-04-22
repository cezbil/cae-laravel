<?php

namespace App\Domain\Event\Query\FindFlightsForNextWeek;

use App\Domain\Bus\Query\QueryHandler;
use App\Domain\Event\Repositories\EventRepository;

class FindFlightsForNextWeekHandler extends QueryHandler
{
    public function __construct(private EventRepository $repository)
    {
    }

    public function handle(FindFlightsForNextWeek $query): array
    {
        return $this->repository->findFlightsNextWeek();
    }
}
