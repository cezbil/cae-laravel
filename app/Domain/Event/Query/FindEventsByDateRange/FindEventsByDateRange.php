<?php

declare(strict_types=1);

namespace App\Domain\Event\Query\FindEventsByDateRange;

use App\Domain\Bus\Query\Query;

class FindEventsByDateRange extends Query
{
    public function __construct(public \DateTimeImmutable $startDate, public \DateTimeImmutable $endDate)
    {
    }

    public function getStartDate(): \DateTimeImmutable
    {
        return $this->startDate;
    }

    public function getEndDate(): \DateTimeImmutable
    {
        return $this->endDate;
    }
}
