<?php

declare(strict_types=1);


namespace App\Domain\Event\Query\FindFlightsByStartLocation;

use App\Domain\Bus\Query\QueryHandler;
use App\Domain\Event\Repositories\EventRepository;

class FindFlightsByStartLocationHandler extends QueryHandler
{
    public function __construct(private EventRepository $repository)
    {
    }

    public function handle(FindFlightsByStartLocation $query): array
    {
        return $this->repository->findFlightsByStartLocation($query->getStartLocation());
    }
}
