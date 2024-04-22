<?php

declare(strict_types=1);

namespace App\Domain\Event\Query\FindFlightsByStartLocation;

use App\Domain\Bus\Query\Query;

class FindFlightsByStartLocation extends Query
{
    public function __construct(public string $startLocation)
    {
    }

    public function getStartLocation(): string
    {
        return $this->startLocation;
    }

    public function setStartLocation(string $startLocation): void
    {
        $this->startLocation = $startLocation;
    }
}
