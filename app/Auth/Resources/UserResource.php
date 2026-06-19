<?php

declare(strict_types=1);

namespace App\Auth\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct(mixed $resource, protected ?string $token)
    {
        parent::__construct($resource);
    }

    public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'token' => $this->token,
            'username' => $this->username,
            'bio' => $this->bio ?? null,
            'image' => $this->image ?? null,
        ];
    }
}
