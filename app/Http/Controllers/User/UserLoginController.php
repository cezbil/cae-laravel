<?php

namespace App\Http\Controllers\User;

use App\Domain\Event\Services\Command\LoginUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use Knuckles\Scribe\Attributes\Unauthenticated;

/**
 * @group User
 *
 * for user Login
 *
 * @subgroup Login
 * @subgroupDescription Do user auth actions
 */
#[Unauthenticated]
class UserLoginController extends Controller
{
    public function __construct(private readonly LoginUserService $loginUserService)
    {
    }
    public function __invoke(
        LoginUserRequest $request
    ): mixed {
        $validatedData = $request->validated();

        return $this->loginUserService->loginUser($validatedData);
    }
}
