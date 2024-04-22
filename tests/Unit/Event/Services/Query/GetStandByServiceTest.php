<?php

namespace Event\Services\Query;

use App\Domain\Bus\Query\QueryBus;
use App\Domain\Event\Query\FindStandByForNextWeek\FindStandByForNextWeek;
use App\Domain\Event\Services\Query\GetStandByService;
use PHPUnit\Framework\TestCase;

class GetStandByServiceTest extends TestCase
{
    private QueryBus $queryBusMock;
    private GetStandByService $getStandByService;

    protected function setUp(): void
    {
        $this->queryBusMock = $this->createMock(QueryBus::class);

        $this->getStandByService = new GetStandByService($this->queryBusMock);
    }


    public function testGetStandByForNextWeekDispatchesCorrectQuery()
    {
        $expectedResult = [new \stdClass()];


        $this->queryBusMock->expects($this->once())
            ->method('ask')
            ->with($this->isInstanceOf(FindStandByForNextWeek::class))
            ->willReturn($expectedResult);

        $result = $this->getStandByService->getStandByForNextWeek();

        $this->assertEquals($expectedResult, $result, 'The returned array of standby events should match the expected result');
    }
}
