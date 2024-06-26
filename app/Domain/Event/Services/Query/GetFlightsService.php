<?php

namespace App\Domain\Event\Services\Query;

use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocation;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeek;

class GetFlightsService
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    /**
     * @throws \Exception
     */
    public function getFlightsNextWeek(): array
    {
        return $this->queryBus->ask(new FindFlightsForNextWeek());
    }
    public function getFlightsFromStartLocation(string $startLocation): array
    {
        return $this->queryBus->ask(new FindFlightsByStartLocation($startLocation));
    }
}
