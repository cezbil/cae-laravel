<?php
declare(strict_types=1);

namespace App\Domain\Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\CreateEvent\CreateEvent;

class CreateEventService
{
    public function __construct(private readonly CommandBus $commandBus) {}

    public function createEvent(array $data): void
    {
        $createEventCommand = new CreateEvent(
            date: $data['date'],
            revision: $data['revision'],
            dutyCode: $data['dutyCode'],
            checkInLocalTime: $data['checkInLocalTime'],
            checkInZuluTime: $data['checkInZuluTime'],
            checkOutLocalTime: $data['checkOutLocalTime'],
            checkOutZuluTime: $data['checkOutZuluTime'],
            activityType: $data['activityType'],
            activityRemark: $data['activityRemark'],
            fromStation: $data['fromStation'],
            stdLocalTime: $data['stdLocalTime'],
            stdZuluTime: $data['stdZuluTime'],
            toStation: $data['toStation'],
            staLocalTime: $data['staLocalTime'],
            staZuluTime: $data['staZuluTime'],
            aircraftOrHotel: $data['aircraftOrHotel'],
            blockHours: $data['blockHours'],
            flightTime: $data['flightTime'],
            nightTime: $data['nightTime'],
            duration: $data['duration'],
            extraDetails: $data['extraDetails']
        );

        $this->commandBus->dispatch($createEventCommand);
    }
}
