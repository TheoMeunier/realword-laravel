<?php

namespace App\Auth\Controllers;

use App\Auth\Actions\LoginAction;
use App\Auth\Requests\LoginRequest;
use App\Auth\Resources\UserResource;
use App\Core\Exceptions\InvalidCredentialsException;

readonly class LoginController
{
    public function __construct(
        private LoginAction $loginAction
    )
    {
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function login(LoginRequest $request): UserResource
    {
        return $this->loginAction->execute($request);
    }
}
