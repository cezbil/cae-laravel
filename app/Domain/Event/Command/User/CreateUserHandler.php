<?php

namespace App\Domain\Event\Command\User;

use App\Domain\Bus\Command\CommandHandler;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class CreateUserHandler extends CommandHandler
{
    public function handle(CreateUser $command): JsonResponse
    {
        User::create([
            'name' => $command->getName(),
            'email' => $command->getEmail(),
            'password' => Hash::make($command->getPassword()),
        ]);

        return response()->json([
            'message' => 'User Created',
        ]);
    }
}
