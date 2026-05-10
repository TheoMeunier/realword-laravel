<?php

namespace App\Auth\Controllers;

use App\Auth\Actions\RegisterAction;
use App\Auth\Requests\RegisterRequest;
use App\Auth\Resources\ProfileResource;

readonly class RegisterController
{
    public function __construct(
        private RegisterAction $registerAction
    )
    {
    }

    public function register(RegisterRequest $request): ProfileResource
    {
       return $this->registerAction->execute($request);
    }
}
