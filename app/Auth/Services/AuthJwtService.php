<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJwtService
{
    public function generateToken(User $user): string
    {
        return JWTAuth::fromUser($user);
    }

    public function revokeToken(): void
    {
        JWTAuth::parseToken()->invalidate();
    }
}
