<?php

declare(strict_types=1);

namespace App\Profile\Controllers;

use App\Core\Exceptions\NotFoundException;
use App\Profile\Actions\GetUserProfileAction;
use Illuminate\Http\Resources\Json\JsonResource;

readonly class ShowUserController
{
    public function __construct(
        private GetUserProfileAction $getUserProfileAction
    )
    {
    }

    /**
     * @throws NotFoundException
     */
    public function show(string $username): JsonResource
    {
        return  $this->getUserProfileAction->execute($username);
    }
}
