<?php

namespace App\Domain\Event\Services\Query;

use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use Illuminate\Support\Facades\Bus;

class GetEventsByDateRangeService
{
    public function getEventsByDateRange(\DateTimeImmutable $start, \DateTimeImmutable $end): array
    {
        return Bus::dispatch(new FindEventsByDateRange($start, $end));
    }
}
