<?php

namespace Event\Query;

use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRangeHandler;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocation;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocationHandler;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeek;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeekHandler;
use App\Domain\Event\Query\FindStandByForNextWeek\FindStandByForNextWeek;
use App\Domain\Event\Query\FindStandByForNextWeek\FindStandByForNextWeekHandler;
use App\Domain\Event\Repositories\EventRepository;
use PHPUnit\Framework\TestCase;

class FindStandByForNextWeekHandlerTest extends TestCase
{
    private EventRepository $repositoryMock;
    private FindStandByForNextWeekHandler $handler;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(EventRepository::class);
        $this->handler = new FindStandByForNextWeekHandler($this->repositoryMock);
    }
    public function testHandle()
    {
        $expectedResult = [
            ['event_id' => 201, 'status' => 'StandBy', 'details' => 'On call'],
            ['event_id' => 202, 'status' => 'StandBy', 'details' => 'Night shift']
        ];

        $query = new FindStandByForNextWeek();

        $this->repositoryMock->expects($this->once())
            ->method('findStandByNextWeek')
            ->willReturn($expectedResult);

        $result = $this->handler->handle($query);

        $this->assertEquals($expectedResult, $result, 'The handler should return the correct standby events for the next week.');
    }

}
