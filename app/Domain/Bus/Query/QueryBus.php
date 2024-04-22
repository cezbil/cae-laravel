<?php

declare(strict_types=1);

namespace App\Domain\Bus\Query;

use App\Domain\Bus\Interfaces\QueryBus as QB;
use Illuminate\Bus\Dispatcher;

class QueryBus implements QB
{
    public function __construct(
        protected Dispatcher $commandBus,
    ) {
    }
    public function ask(Query $query): mixed
    {
        return $this->commandBus->dispatch($query);
    }

    public function register(array $map): void
    {
        $this->commandBus->map($map);
    }
}
