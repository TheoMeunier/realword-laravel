<?php

declare(strict_types=1);

namespace App\Profile\Controllers;

use App\Core\Exceptions\NotFoundException;
use App\Profile\Actions\FollowProfileAction;
use Illuminate\Http\Resources\Json\JsonResource;

readonly class FollowController
{
    public function __construct(
        private FollowProfileAction $followProfileAction
    ) {}

    /**
     * @throws NotFoundException
     */
    public function follow(string $username): JsonResource
    {
        return $this->followProfileAction->execute($username);
    }
}
