<?php

declare(strict_types=1);

namespace App\Auth\Services;

use App\Auth\Models\User;
use Illuminate\Auth\AuthManager;
use Tymon\JWTAuth\JWTGuard;

readonly class AuthJwtService
{
    private JWTGuard $guard;

    public function __construct(AuthManager $auth)
    {
        /** @var JWTGuard $guard */
        $guard = $auth->guard('api');
        $this->guard = $guard;
    }

    public function generateToken(User $user): string
    {
        return $this->guard->login($user);
    }

    public function revokeToken(): void
    {
        $this->guard->logout();
    }
}
