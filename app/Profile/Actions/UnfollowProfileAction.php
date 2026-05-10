<?php

declare(strict_types=1);

namespace App\Profile\Actions;

use App\Auth\Models\User;
use App\Auth\Resources\ProfileResource;
use App\Core\Exceptions\NotFoundException;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnfollowProfileAction
{
    public function execute(string $username): JsonResource
    {
        $user = User::query()->where('username', $username)->firstOrFail();

        if (!$user) { throw new NotFoundException("User not found"); }

        $user->following = false;
        $user->save();

        return ProfileResource::make($user);
    }
}
