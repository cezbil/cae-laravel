<?php

namespace Event\Services\Command;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Event\Command\User\LoginUser;
use App\Domain\Event\Services\Command\LoginUserService;
use PHPUnit\Framework\TestCase;

class LoginUserServiceTest extends TestCase
{
    private CommandBus $commandBusMock;
    private LoginUserService $loginUserService;

    protected function setUp(): void
    {
        $this->commandBusMock = $this->createMock(CommandBus::class);

        $this->loginUserService = new LoginUserService($this->commandBusMock);
    }

    public function testLoginUserDispatchesCommandAndReturnsResult()
    {
        $loginData = [
            'email' => 'user@example.com',
            'password' => 'userpassword'
        ];

        $expectedResult = 'session_token';

        $this->commandBusMock->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo(new LoginUser(
                email: $loginData['email'],
                password: $loginData['password']
            )))
            ->willReturn($expectedResult);

        $result = $this->loginUserService->loginUser($loginData);

        $this->assertEquals($expectedResult, $result, 'The result of loginUser should be the expected session token');
    }
}
