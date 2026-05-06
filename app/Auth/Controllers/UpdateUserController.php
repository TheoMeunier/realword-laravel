<?php

declare(strict_types=1);

namespace App\Auth\Controllers;

use App\Auth\Actions\UpdateUserAction;
use App\Auth\Requests\UpdateUserRequest;
use App\Auth\Resources\UserResource;

readonly class UpdateUserController
{

    public function __construct(
        private UpdateUserAction $updateUserAction
    )
    {
    }

    public function update(UpdateUserRequest $request): UserResource
    {
        return $this->updateUserAction->execute($request);
    }
}
