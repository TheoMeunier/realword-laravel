<?php

declare(strict_types=1);

namespace App\Profile\Actions;

use App\Auth\Models\User;
use App\Profile\Resources\ProfileResource;

final class GetUserProfileAction
{
    public function execute(string $username): ProfileResource
    {
        $user = User::query()->where('username', $username)->firstOrFail();

        return ProfileResource::make($user);
    }
}
