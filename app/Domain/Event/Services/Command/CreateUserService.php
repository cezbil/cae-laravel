<?php

namespace App\Domain\Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\User\CreateUser;

class CreateUserService
{
    public function __construct(private readonly CommandBus $commandBus) {}

    public function createUser(array $data): void
    {
        $createUserCommand = new CreateUser(
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );

        $this->commandBus->dispatch($createUserCommand);
    }

}
