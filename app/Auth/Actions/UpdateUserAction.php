<?php

declare(strict_types=1);

namespace App\Auth\Actions;

use App\Auth\Requests\UpdateUserRequest;
use App\Auth\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UpdateUserAction
{
    public function execute(UpdateUserRequest $request): ProfileResouUserResourcerce
    {
        $user = Auth::user();
        $user->update($request->validated());

        return new UserResource($user, $request->bearerToken());
    }
}
