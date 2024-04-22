<?php

namespace Tests\Unit\User\Command;

use App\Domain\Event\Command\User\CreateUser;
use App\Domain\Event\Command\User\CreateUserHandler;
use App\Domain\Event\Command\User\LoginUser;
use App\Domain\Event\Command\User\LoginUserHandler;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginUserHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testHandleReturnsTokenForValidCredentials()
    {
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password)
        ]);

        $command = new LoginUser($user->email, $password);
        $handler = new LoginUserHandler();

        $response = $handler->handle($command);

        $this->assertArrayHasKey('access_token', $response->getOriginalContent());
    }

    public function testHandleReturnsErrorForInvalidCredentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        $command = new LoginUser($user->email, 'wrongpassword');
        $handler = new LoginUserHandler();

        $response = $handler->handle($command);

        $this->assertEquals('Invalid Credentials', $response->getOriginalContent()['message']);
    }
}
