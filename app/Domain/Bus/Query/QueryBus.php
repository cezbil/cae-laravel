<?php

declare(strict_types=1);

namespace App\Domain\Bus\Query;

use App\Domain\Bus\Interfaces\QueryBus as QB;
use Illuminate\Bus\Dispatcher;

class QueryBus implements QB
{
    public function __construct(
        protected Dispatcher $queryBus,
    ) {
    }
    public function ask(Query $query): mixed
    {
        return $this->queryBus->dispatch($query);
    }

    public function register(array $map): void
    {
        $this->queryBus->map($map);
    }
}
