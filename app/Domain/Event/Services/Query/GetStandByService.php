<?php

namespace App\Domain\Event\Services\Query;

use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Query\FindStandByForNextWeek\FindStandByForNextWeek;

class GetStandByService
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    /**
     * @throws \Exception
     */
    public function getStandByForNextWeek(): array
    {
        return $this->queryBus->ask(new FindStandByForNextWeek());
    }
}
