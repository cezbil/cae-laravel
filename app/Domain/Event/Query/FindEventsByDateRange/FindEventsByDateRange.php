<?php
declare(strict_types=1);

namespace App\Domain\Event\Query\FindEventsByDateRange;

class FindEventsByDateRange
{
    public function __construct(public \DateTimeImmutable $startDate, public \DateTimeImmutable $endDate) {}

}
