<?php

declare(strict_types=1);

namespace App\Auth\Controllers;

use App\Auth\Models\User;
use App\Auth\Resources\ProfileResource;
use App\Auth\Resources\UserResource;
use App\Core\Exceptions\NotFoundException;
use Illuminate\Http\Request;

final class ShowUserController
{
    /**
     * @throws NotFoundException
     */
    public function show(Request $request): UserResource
    {
        $user = User::query()->where('id', auth()->id())->firstOrFail();

        throw_unless($user, NotFoundException::class, 'User not found');

        return new ProfileResource($user, $request->bearerToken());
    }
}
