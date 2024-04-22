<?php

namespace Event\Query;

use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRangeHandler;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocation;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocationHandler;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeek;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeekHandler;
use App\Domain\Event\Repositories\EventRepository;
use PHPUnit\Framework\TestCase;

class FindFlightsForNextWeekHandlerTest extends TestCase
{
    private EventRepository $repositoryMock;
    private FindFlightsForNextWeekHandler $handler;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(EventRepository::class);
        $this->handler = new FindFlightsForNextWeekHandler($this->repositoryMock);
    }

    public function testHandle()
    {
        $expectedResult = [
            ['flight_id' => 101, 'flight_code' => 'DX101'],
            ['flight_id' => 102, 'flight_code' => 'DX102']
        ];

        $query = new FindFlightsForNextWeek();

        $this->repositoryMock->expects($this->once())
            ->method('findFlightsNextWeek')
            ->willReturn($expectedResult);

        $result = $this->handler->handle($query);

        $this->assertEquals($expectedResult, $result, 'The handler should return the correct flights for the next week.');
    }
}
