<?php

namespace App\Auth\Controllers;

use App\Auth\Actions\LoginAction;
use App\Auth\Requests\CreateArticleRequest;
use App\Auth\Resources\ProfileResource;
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
    public function login(CreateArticleRequest $request): UserResource
    {
        return $this->loginAction->execute($request);
    }
}
