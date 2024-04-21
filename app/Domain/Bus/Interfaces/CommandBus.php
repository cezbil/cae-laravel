<?php
declare(strict_types=1);

namespace App\Domain\Bus\Interfaces;

use App\Domain\Bus\Command\Command;

interface CommandBus
{
    public function dispatch(Command $command): mixed;

    public function register(array $map): void;
}
