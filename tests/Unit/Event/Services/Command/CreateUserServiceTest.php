<?php

namespace Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\User\CreateUser;
use App\Domain\Event\Services\Command\CreateUserService;
use PHPUnit\Framework\TestCase;

class CreateUserServiceTest extends TestCase
{
    private CommandBus $commandBusMock;
    private CreateUserService $createUserService;

    protected function setUp(): void
    {
        $this->commandBusMock = $this->createMock(CommandBus::class);

        $this->createUserService = new CreateUserService($this->commandBusMock);
    }

    public function testCreateUserDispatchesCommand()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'securepassword123'
        ];

        $expectedCommand = new CreateUser(
            name: $userData['name'],
            email: $userData['email'],
            password: $userData['password']
        );

        $this->commandBusMock->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo($expectedCommand));

        $this->createUserService->createUser($userData);
    }
}
