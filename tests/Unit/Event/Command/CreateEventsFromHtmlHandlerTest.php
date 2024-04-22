<?php

namespace Event\Command;

use App\Domain\Event\Command\CreateEvent\CreateEvent;
use App\Domain\Event\Command\CreateEvent\CreateEventHandler;
use App\Domain\Event\Command\CreateEventsFromHtml\CreateEventsFromHtml;
use App\Domain\Event\Command\CreateEventsFromHtml\CreateEventsFromHtmlHandler;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Repositories\EventRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class CreateEventsFromHtmlHandlerTest extends TestCase
{
    use RefreshDatabase, CreatesApplication;

    public function testHandleMultipleEvents()
    {
        $mockRepo = $this->createMock(EventRepository::class);
        $counter = 0;
        $mockRepo->expects($this->exactly(3))
            ->method('save')
            ->with($this->callback(function($event) use (&$counter)
            {
                $counter++;
                if ($counter === 1){
                    return $event->duty_code === 'D123';
                }
                if ($counter === 2){
                    return $event->duty_code === 'D456';
                }
                if ($counter === 3){
                    return $event->duty_code === 'D789';
                }
            })
            );

        $eventsData = [
            new Event(['date' => '2022-01-01', 'duty_code' => 'D123', 'activity' => 'Flight']),
            new Event(['date' => '2022-01-02', 'duty_code' => 'D456', 'activity' => 'Maintenance']),
            new Event(['date' => '2022-01-03', 'duty_code' => 'D789', 'activity' => 'Training'])
        ];

        $command = new CreateEventsFromHtml($eventsData);

        $handler = new CreateEventsFromHtmlHandler($mockRepo);
        $handler->handle($command);
    }
}
