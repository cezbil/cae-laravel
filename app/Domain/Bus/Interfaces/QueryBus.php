<?php
declare(strict_types=1);

namespace App\Domain\Bus\Interfaces;


use App\Domain\Bus\Query\Query;

interface QueryBus
{
    public function ask(Query $query): mixed;

    public function register(array $map): void;
}
