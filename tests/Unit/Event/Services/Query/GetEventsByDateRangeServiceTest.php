<?php

namespace Event\Services\Query;

use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use App\Domain\Event\Services\Query\GetEventsByDateRangeService;
use PHPUnit\Framework\TestCase;

class GetEventsByDateRangeServiceTest extends TestCase
{
    private QueryBus $queryBusMock;
    private GetEventsByDateRangeService $getEventsByDateRangeService;

    protected function setUp(): void
    {
        $this->queryBusMock = $this->createMock(QueryBus::class);

        $this->getEventsByDateRangeService = new GetEventsByDateRangeService($this->queryBusMock);
    }

    public function testGetEventsByDateRangeDispatchesQueryAndHandlesResult()
    {
        $dateRange = [
            'startDate' => '2021-01-01',
            'endDate' => '2021-01-31'
        ];

        $expectedResult = [new \stdClass()];

        $this->queryBusMock->expects($this->once())
            ->method('ask')
            ->with($this->callback(function ($query) use ($dateRange) {
                return $query instanceof FindEventsByDateRange &&
                    $query->getStartDate()->format('Y-m-d') === $dateRange['startDate'] &&
                    $query->getEndDate()->format('Y-m-d') === $dateRange['endDate'];
            }))
            ->willReturn($expectedResult);

        $result = $this->getEventsByDateRangeService->getEventsByDateRange($dateRange);

        $this->assertEquals($expectedResult, $result, 'The returned array of events should match the expected result');
    }
}
