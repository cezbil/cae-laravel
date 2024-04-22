<?php

namespace Bus\Command;

use App\Domain\Bus\Command\Command;
use App\Domain\Bus\Command\CommandBus;
use Illuminate\Bus\Dispatcher;
use PHPUnit\Framework\TestCase;

class CommandBusTest extends TestCase
{
    private Dispatcher $dispatcherMock;
    private CommandBus $commandBus;

    protected function setUp(): void
    {
        $this->dispatcherMock = $this->createMock(Dispatcher::class);
        $this->commandBus = new CommandBus($this->dispatcherMock);
    }

    public function testDispatch()
    {
        $commandMock = $this->createMock(Command::class);

        $this->dispatcherMock->expects($this->once())
            ->method('dispatch')
            ->with($commandMock)
            ->willReturn('expectedResult');

        $result = $this->commandBus->dispatch($commandMock);

        $this->assertEquals('expectedResult', $result);
    }

    public function testRegister()
    {
        $map = ['commandName' => 'handlerClass'];

        $this->dispatcherMock->expects($this->once())
            ->method('map')
            ->with($map);

        $this->commandBus->register($map);
    }
}
