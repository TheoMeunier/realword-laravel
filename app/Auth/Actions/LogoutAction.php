<?php

namespace App\Auth\Actions;

use App\Auth\Services\AuthJwtService;

readonly class LogoutAction
{
    public function __construct(
        private AuthJwtService $service
    ) {}

    public function execute(int $userId): void
    {
        $this->service->revokeToken($userId);
    }
}
