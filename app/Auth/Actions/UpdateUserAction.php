<?php

declare(strict_types=1);

namespace App\Auth\Actions;

use App\Auth\Requests\UpdateUserRequest;
use App\Auth\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;

class UpdateUserAction
{
    public function execute(UpdateUserRequest $request): ProfileResource
    {
        $user = Auth::user();
        $user->update($request->validated());

        return new ProfileResource($user, $request->bearerToken());
    }
}
