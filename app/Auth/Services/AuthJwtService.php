<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Models\User;

class AuthJwtService
{
    public function generateToken(User $user): string
    {
        $model = User::query()->findOrFail($user->id);

        return $model->createToken('api-token')->plainTextToken;
    }

    public function revokeToken(int $userId): void
    {
        $model = User::query()->findOrFail($userId);

        $model->tokens()->delete();
    }
}
