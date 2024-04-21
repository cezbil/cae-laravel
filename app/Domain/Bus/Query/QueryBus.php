<?php
declare(strict_types=1);

namespace App\Domain\Bus\Query;

use Illuminate\Bus\Dispatcher;
use \App\Domain\Bus\Interfaces\QueryBus as QB;

class QueryBus implements QB
{
    public function __construct(
        protected Dispatcher $commandBus,
    ) {}
    public function ask(Query $query): mixed
    {
        return $this->commandBus->dispatch($query);
    }

    public function register(array $map): void
    {
        $this->commandBus->map($map);
    }
}
