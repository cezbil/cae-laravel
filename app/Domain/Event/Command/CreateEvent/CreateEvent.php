<?php

declare(strict_types=1);

namespace App\Domain\Event\Command\CreateEvent;

use App\Domain\Bus\Command\Command;

class CreateEvent extends Command
{
    public function __construct(
        public string $date,
        public ?string $revision,
        public string $dutyCode,
        public ?string $checkInLocalTime,
        public ?string $checkInZuluTime,
        public ?string $checkOutLocalTime,
        public ?string $checkOutZuluTime,
        public string $activityType,
        public ?string $activityRemark,
        public string $fromStation,
        public ?string $stdLocalTime,
        public ?string $stdZuluTime,
        public string $toStation,
        public ?string $staLocalTime,
        public ?string $staZuluTime,
        public ?string $aircraftOrHotel,
        public ?string $blockHours,
        public ?string $flightTime,
        public ?string $nightTime,
        public ?string $duration,
        public ?string $extraDetails
    ) {
    }
}
