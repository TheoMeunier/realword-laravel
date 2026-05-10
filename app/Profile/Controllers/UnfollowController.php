<?php

declare(strict_types=1);

namespace App\Profile\Controllers;

use App\Core\Exceptions\NotFoundException;
use App\Profile\Actions\FollowProfileAction;
use App\Profile\Actions\UnfollowProfileAction;
use Illuminate\Http\Resources\Json\JsonResource;

readonly class UnfollowController
{
    public function __construct(
        private UnfollowProfileAction $unfollowProfileAction,
    )
    {
    }

    /**
     * @throws NotFoundException
     */
    public function unfollow(string $username): JsonResource
    {
        return $this->unfollowProfileAction->execute($username);
    }
}

