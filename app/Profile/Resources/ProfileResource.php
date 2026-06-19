<?php

declare(strict_types=1);

namespace App\Profile\Resources;

use App\Auth\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public static $wrap = 'profile';

    public function toArray(Request $request): array
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        return [
            'username' => $this->username,
            'bio' => $this->bio,
            'image' => $this->image,
            'following' => $authUser && $authUser->isFollowing($this->resource),
        ];
    }
}
