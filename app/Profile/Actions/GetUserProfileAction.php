<?php

declare(strict_types=1);

namespace App\Profile\Actions;

use App\Auth\Models\User;
use App\Auth\Resources\ProfileResource;
use App\Core\Exceptions\NotFoundException;

final class GetUserProfileAction
{
    /**
     * @throws NotFoundException
     */
    public function execute(string $username)
    {
        $user = User::query()->where('username', $username)->firstOrFail();

        if (!$user) { throw new NotFoundException("User not found"); }

        return ProfileResource::make($user);
    }
}
