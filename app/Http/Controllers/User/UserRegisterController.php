<?php

namespace App\Http\Controllers\User;

use App\Domain\Event\Services\Command\CreateUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Knuckles\Scribe\Attributes\Unauthenticated;

/**
 * @group User
 *
 * for user register
 *
 * @subgroup Register
 * @subgroupDescription Do user auth actions
 */
#[Unauthenticated]
class UserRegisterController extends Controller
{
    public function __construct(private readonly CreateUserService $createUserService)
    {
    }

    public function __invoke(
        CreateUserRequest $request
    ): JsonResponse {
        $validatedData = $request->validated();

        $this->createUserService->createUser($validatedData);

        return response()->json([
            'message' => 'User successfully created',
            'success' => true,
        ]);
    }
}
