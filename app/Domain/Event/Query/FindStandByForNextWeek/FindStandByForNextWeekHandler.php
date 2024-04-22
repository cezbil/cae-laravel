<?php

declare(strict_types=1);

namespace App\Domain\Event\Query\FindStandByForNextWeek;

use App\Domain\Bus\Query\QueryHandler;
use App\Domain\Event\Repositories\EventRepository;

class FindStandByForNextWeekHandler extends QueryHandler
{
    public function __construct(private EventRepository $repository)
    {
    }

    public function handle(FindStandByForNextWeek $query): array
    {
        return $this->repository->findStandByNextWeek();
    }
}
