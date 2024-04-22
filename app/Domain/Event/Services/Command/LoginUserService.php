<?php

namespace App\Domain\Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\User\LoginUser;

class LoginUserService
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    public function loginUser(array $data): mixed
    {
        $loginUserCommand = new LoginUser(
            email: $data['email'],
            password: $data['password']
        );

        return $this->commandBus->dispatch($loginUserCommand);
    }
}
