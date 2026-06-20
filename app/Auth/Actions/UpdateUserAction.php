<?php

declare(strict_types=1);

namespace App\Auth\Actions;

use App\Auth\Requests\UpdateUserRequest;
use App\Auth\Resources\UserResource;
use App\Core\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Auth;

class UpdateUserAction
{
    /**
     * @throws NotFoundException
     */
    public function execute(UpdateUserRequest $request): UserResource
    {
        $user = Auth::user();

        throw_unless($user, NotFoundException::class);

        $user->update($request->validated());

        return new UserResource($user, $request->bearerToken());
    }
}
