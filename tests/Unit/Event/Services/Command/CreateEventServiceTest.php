<?php

namespace Tests\Unit\Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\CreateEvent\CreateEvent;
use App\Domain\Event\Services\Command\CreateEventService;
use PHPUnit\Framework\TestCase;

class CreateEventServiceTest extends TestCase
{
    private CommandBus $commandBusMock;
    private CreateEventService $createEventService;

    protected function setUp(): void
    {
        $this->commandBusMock = $this->createMock(CommandBus::class);

        $this->createEventService = new CreateEventService($this->commandBusMock);
    }
    public function testCreateEventDispatchesCommand(): void
    {
        // Arrange
        $eventData = [
            'date' => '2022-01-01',
            'revision' => 'A',
            'dutyCode' => 'FL123',
            'checkInLocalTime' => '08:00',
            'checkInZuluTime' => '12:00',
            'checkOutLocalTime' => '20:00',
            'checkOutZuluTime' => '00:00',
            'activityType' => 'Flight',
            'activityRemark' => 'On time',
            'fromStation' => 'JFK',
            'stdLocalTime' => '10:00',
            'stdZuluTime' => '14:00',
            'toStation' => 'LAX',
            'staLocalTime' => '13:00',
            'staZuluTime' => '17:00',
            'aircraftOrHotel' => 'Boeing 737',
            'blockHours' => '6',
            'flightTime' => '5',
            'nightTime' => '0',
            'duration' => '10',
            'extraDetails' => 'Meal provided'
        ];

        $expectedCommand = new CreateEvent(
            date: $eventData['date'],
            revision: $eventData['revision'],
            dutyCode: $eventData['dutyCode'],
            checkInLocalTime: $eventData['checkInLocalTime'],
            checkInZuluTime: $eventData['checkInZuluTime'],
            checkOutLocalTime: $eventData['checkOutLocalTime'],
            checkOutZuluTime: $eventData['checkOutZuluTime'],
            activityType: $eventData['activityType'],
            activityRemark: $eventData['activityRemark'],
            fromStation: $eventData['fromStation'],
            stdLocalTime: $eventData['stdLocalTime'],
            stdZuluTime: $eventData['stdZuluTime'],
            toStation: $eventData['toStation'],
            staLocalTime: $eventData['staLocalTime'],
            staZuluTime: $eventData['staZuluTime'],
            aircraftOrHotel: $eventData['aircraftOrHotel'],
            blockHours: $eventData['blockHours'],
            flightTime: $eventData['flightTime'],
            nightTime: $eventData['nightTime'],
            duration: $eventData['duration'],
            extraDetails: $eventData['extraDetails']
        );
        $this->commandBusMock->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo($expectedCommand));

        $this->createEventService->createEvent($eventData);
    }
}
