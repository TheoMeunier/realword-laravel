<?php

declare(strict_types=1);

namespace App\Profile\Actions;

use App\Auth\Models\User;
use App\Core\Exceptions\InvalidCredentialsException;
use App\Profile\Resources\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnfollowProfileAction
{
    /**
     * @throws InvalidCredentialsException
     */
    public function execute(string $username): JsonResource
    {
        $target = User::query()->where('username', $username)->firstOrFail();

        throw_unless(auth()->user(), InvalidCredentialsException::class);

        auth()->user()->following()->detach($target->id);

        return ProfileResource::make($target);
    }
}
