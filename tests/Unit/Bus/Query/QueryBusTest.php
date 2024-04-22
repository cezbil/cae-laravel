<?php

namespace Bus\Query;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Command\CommandBus;
use App\Domain\Bus\Query\Query;
use App\Domain\Bus\Query\QueryBus;
use Illuminate\Bus\Dispatcher;
use PHPUnit\Framework\TestCase;

class QueryBusTest extends TestCase
{
    private Dispatcher $dispatcherMock;
    private QueryBus $queryBus;

    protected function setUp(): void
    {
        $this->dispatcherMock = $this->createMock(Dispatcher::class);
        $this->queryBus = new QueryBus($this->dispatcherMock);
    }

    public function testAsk()
    {
        $queryMock = $this->createMock(Query::class);

        $this->dispatcherMock->expects($this->once())
            ->method('dispatch')
            ->with($queryMock)
            ->willReturn('expectedResult');

        $result = $this->queryBus->ask($queryMock);

        $this->assertEquals('expectedResult', $result);
    }

    public function testRegister()
    {
        $map = ['queryName' => 'handlerClass'];

        $this->dispatcherMock->expects($this->once())
            ->method('map')
            ->with($map);

        $this->queryBus->register($map);
    }
}
