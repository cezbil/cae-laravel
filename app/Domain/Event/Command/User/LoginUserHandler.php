<?php

namespace App\Domain\Event\Command\User;

use App\Domain\Bus\Command\CommandBus;
use App\Domain\Bus\Command\CommandHandler;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginUserHandler extends CommandHandler
{
    public function handle(LoginUser $command): JsonResponse
    {
        $user = User::where('email', $command->getEmail())->first();

        if (!$user || !Hash::check($command->getPassword(), $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }
}
