<?php

namespace Event\Query;

use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRange;
use App\Domain\Event\Query\FindEventsByDateRange\FindEventsByDateRangeHandler;
use App\Domain\Event\Repositories\EventRepository;
use PHPUnit\Framework\TestCase;

class FindEventsByDateRangeHandlerTest extends TestCase
{
    private EventRepository $repositoryMock;
    private FindEventsByDateRangeHandler $handler;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->createMock(EventRepository::class);
        $this->handler = new FindEventsByDateRangeHandler($this->repositoryMock);
    }

    public function testHandle()
    {
        $query = new FindEventsByDateRange(new \DateTimeImmutable('2022-01-01'), new \DateTimeImmutable('2022-01-31'));

        $expectedResult = [
            ['event_id' => 1, 'event_name' => 'Event One'],
            ['event_id' => 2, 'event_name' => 'Event Two']
        ];

        $this->repositoryMock->expects($this->once())
            ->method('findByDateRange')
            ->with(
                $this->equalTo($query->startDate),
                $this->equalTo($query->endDate)
            )
            ->willReturn($expectedResult);

        $result = $this->handler->handle($query);

        $this->assertEquals($expectedResult, $result);
    }
}
