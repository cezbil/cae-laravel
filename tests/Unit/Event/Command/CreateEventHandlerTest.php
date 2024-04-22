<?php

namespace Event\Command;

use App\Domain\Event\Command\CreateEvent\CreateEvent;
use App\Domain\Event\Command\CreateEvent\CreateEventHandler;
use App\Domain\Event\Repositories\EventRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class CreateEventHandlerTest extends TestCase
{
    use RefreshDatabase, CreatesApplication;

    public function testHandle()
    {
        $mockRepo = $this->createMock(EventRepository::class);
        $mockRepo->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($event) {
                return $event->duty_code === 'D123';
            }));
        // Create a command with sample data
        $command = new CreateEvent(
            date: '2022-01-01',
            revision: 'rev-001',
            dutyCode: 'D123',
            checkInLocalTime: '08:00',
            checkInZuluTime: '12:00',
            checkOutLocalTime: '20:00',
            checkOutZuluTime: '24:00',
            activityType: 'Flight',
            activityRemark: 'No delays',
            fromStation: 'JFK',
            stdLocalTime: '09:00',
            stdZuluTime: '13:00',
            toStation: 'LAX',
            staLocalTime: '11:00',
            staZuluTime: '15:00',
            aircraftOrHotel: 'Boeing 777',
            blockHours: 5,
            flightTime: 4.5,
            nightTime: 2,
            duration: 6,
            extraDetails: 'Additional info'
        );

        $handler = new CreateEventHandler($mockRepo);
        $handler->handle($command);
    }
}
