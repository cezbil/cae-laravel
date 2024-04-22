<?php

namespace App\Domain\Event\Services\Query;

use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeek;
use Illuminate\Support\Facades\Bus;

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
}
