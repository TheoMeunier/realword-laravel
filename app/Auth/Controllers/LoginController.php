<?php

namespace App\Auth\Controllers;

use App\Auth\Actions\LoginAction;
use App\Auth\Requests\LoginRequest;
use App\Auth\Resources\ProfileResource;
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
    public function login(LoginRequest $request): ProfileResource
    {
        return $this->loginAction->execute($request);
    }
}
