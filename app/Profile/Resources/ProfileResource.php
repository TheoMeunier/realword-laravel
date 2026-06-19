<?php

declare(strict_types=1);

namespace App\Profile\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public static $wrap = 'profile';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'username' => $this->username,
            'bio' => $this->bio ?? null,
            'image' => $this->image ?? null,
            'following' => $this->following ?? false,
        ];
    }
}
