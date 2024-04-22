<?php

declare(strict_types=1);

namespace App\Domain\Bus\Command;

use App\Domain\Bus\Interfaces\CommandBus as CB;
use Illuminate\Bus\Dispatcher;

class CommandBus implements CB
{
    public function __construct(
        protected Dispatcher $commandBus,
    ) {
    }
    public function dispatch(Command $command): mixed
    {
        return $this->commandBus->dispatch($command);
    }

    public function register(array $map): void
    {
        $this->commandBus->map($map);
    }
}
