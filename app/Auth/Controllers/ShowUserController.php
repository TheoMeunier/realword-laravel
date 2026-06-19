<?php

declare(strict_types=1);

namespace App\Auth\Controllers;

use App\Auth\Models\User;
use App\Auth\Resources\UserResource;
use Illuminate\Http\Request;

final class ShowUserController
{
    public function show(Request $request): UserResource
    {
        /** @var User $user */
        $user = auth()->user();

        return new UserResource($user, $request->bearerToken());
    }
}
