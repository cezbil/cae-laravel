<?php

namespace Tests\Unit\User\Command;

use App\Domain\Event\Command\User\CreateUser;
use App\Domain\Event\Command\User\CreateUserHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserHandlerTest extends TestCase
{
    use RefreshDatabase;


    public function testHandleCreatesNewUser()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123'
        ];

        $command = new CreateUser($data['name'], $data['email'], $data['password']);
        $handler = new CreateUserHandler();

        $userResponse = $handler->handle($command);

        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
        self::assertSame($userResponse->getContent() , json_encode([
            'message' => 'User Created',
        ]));
    }
}
