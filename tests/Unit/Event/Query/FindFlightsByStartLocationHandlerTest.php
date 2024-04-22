<?php

namespace Event\Query;

use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRangeHandler;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocation;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocationHandler;
use App\Domain\Event\Repositories\EventRepository;
use PHPUnit\Framework\TestCase;

class FindFlightsByStartLocationHandlerTest extends TestCase
{
    private EventRepository $repositoryMock;
    private FindFlightsByStartLocationHandler $handler;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(EventRepository::class);
        $this->handler = new FindFlightsByStartLocationHandler($this->repositoryMock);
    }

    public function testHandle()
    {
        $startLocation = 'JFK';
        $expectedResult = [
            ['flight_id' => 1, 'flight_code' => 'JFK123'],
            ['flight_id' => 2, 'flight_code' => 'JFK456']
        ];

        $query = new FindFlightsByStartLocation($startLocation);

        $this->repositoryMock->expects($this->once())
            ->method('findFlightsByStartLocation')
            ->with($this->equalTo($startLocation))
            ->willReturn($expectedResult);

        $result = $this->handler->handle($query);

        $this->assertEquals($expectedResult, $result, 'The handler should return the correct flights based on start location.');
    }
}
