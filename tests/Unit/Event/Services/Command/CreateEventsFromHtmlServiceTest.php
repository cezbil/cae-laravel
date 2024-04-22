<?php

namespace Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\CreateEvent\CreateEvent;
use App\Domain\Event\Command\CreateEventsFromHtml\CreateEventsFromHtml;
use App\Domain\Event\Services\Command\CreateEventsFromHtmlService;
use PHPUnit\Framework\TestCase;

class CreateEventsFromHtmlServiceTest extends TestCase
{
    private CommandBus $commandBusMock;
    private CreateEventsFromHtmlService $createEventsFromHtmlService;

    protected function setUp(): void
    {
        $this->commandBusMock = $this->createMock(CommandBus::class);

        $this->createEventsFromHtmlService = new CreateEventsFromHtmlService($this->commandBusMock);
    }
    public function testCreateEventsDispatchesCommand()
    {
        $eventsData = [
            ['date'     => '2022-01-01',
             'location' => 'JFK',
             'type'     => 'Departure'
            ],
            ['date' => '2022-01-02', 'location' => 'LAX', 'type' => 'Arrival']
        ];

        $expectedCommand = new CreateEventsFromHtml($eventsData);

        $this->commandBusMock->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo($expectedCommand));

        $this->createEventsFromHtmlService->createEvents($eventsData);
    }
}
