<?php

namespace Event\Services\Query;

use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Query\FindFlightsByStartLocation\FindFlightsByStartLocation;
use App\Domain\Event\Query\FindFlightsForNextWeek\FindFlightsForNextWeek;
use App\Domain\Event\Services\Query\GetFlightsService;
use PHPUnit\Framework\TestCase;

class GetFlightsServiceTest extends TestCase
{
    private QueryBus $queryBusMock;
    private GetFlightsService $getFlightsService;

    protected function setUp(): void
    {
        $this->queryBusMock = $this->createMock(QueryBus::class);

        $this->getFlightsService = new GetFlightsService($this->queryBusMock);
    }

    public function testGetFlightsNextWeekDispatchesCorrectQuery()
    {
        $expectedResult = [new \stdClass()];

        $this->queryBusMock->expects($this->once())
            ->method('ask')
            ->with($this->isInstanceOf(FindFlightsForNextWeek::class))
            ->willReturn($expectedResult);

        $result = $this->getFlightsService->getFlightsNextWeek();

        $this->assertEquals($expectedResult, $result, 'The returned array of flights should match the expected result');
    }

    public function testGetFlightsFromStartLocationDispatchesCorrectQuery()
    {
        $startLocation = "JFK";
        $expectedResult = [new \stdClass()];

        $this->queryBusMock->expects($this->once())
            ->method('ask')
            ->with($this->callback(function ($query) use ($startLocation) {
                return $query instanceof FindFlightsByStartLocation &&
                    $query->startLocation === $startLocation;
            }))
            ->willReturn($expectedResult);

        $result = $this->getFlightsService->getFlightsFromStartLocation($startLocation);

        $this->assertEquals($expectedResult, $result, 'The returned array of flights should match the expected result');
    }
}
