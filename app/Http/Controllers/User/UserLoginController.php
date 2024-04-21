<?php

namespace App\Http\Controllers\User;

use App\Domain\Event\Services\Command\CreateUserService;
use App\Domain\Event\Services\Command\LoginUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function __construct(private readonly LoginUserService $loginUserService) {
    }

    public function __invoke(
        LoginUserRequest $request
    ): mixed {
        $validatedData = $request->validated();

        return $this->loginUserService->loginUser($validatedData);
    }
}
