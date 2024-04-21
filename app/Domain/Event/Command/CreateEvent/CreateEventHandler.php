<?php

declare(strict_types=1);

namespace App\Domain\Event\Command\CreateEvent;

use App\Domain\Bus\Command\CommandHandler;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Repositories\EventRepository;

class CreateEventHandler extends CommandHandler
{
    public function __construct(private EventRepository $eventRepository) {}

    public function handle(CreateEventsFromHtml $command): void
    {
        $eventData = [
            'date' => $command->date,
            'revision' => $command->revision,
            'duty_code' => $command->dutyCode,
            'check_in_local' => $command->checkInLocalTime,
            'check_in_utc' => $command->checkInZuluTime,
            'check_out_local' => $command->checkOutLocalTime,
            'check_out_utc' => $command->checkOutZuluTime,
            'activity' => $command->activityType,
            'remark' => $command->activityRemark,
            'from_station' => $command->fromStation,
            'scheduled_time_departure_local' => $command->stdLocalTime,
            'scheduled_time_departure_utc' => $command->stdZuluTime,
            'to_station' => $command->toStation,
            'scheduled_time_arrival_local' => $command->staLocalTime,
            'scheduled_time_arrival_utc' => $command->staZuluTime,
            'aircraft_or_hotel' => $command->aircraftOrHotel,
            'block_hours' => $command->blockHours,
            'flight_time' => $command->flightTime,
            'night_time' => $command->nightTime,
            'duration' => $command->duration,
            'extras' => $command->extraDetails
        ];
        $event = new Event($eventData);
        $this->eventRepository->save($event);
    }
}
