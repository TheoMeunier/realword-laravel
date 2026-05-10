<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExceptionResource extends JsonResource
{
    public static $wrap = 'errors';

    public function toArray(Request $request): array
    {
        return [
            'resource'    => ["not found"],
        ];
    }
}
