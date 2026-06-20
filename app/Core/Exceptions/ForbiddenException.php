<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use App\Core\Exceptions\Resources\ExceptionResource;
use Exception;
use Illuminate\Http\JsonResponse;

class ForbiddenException extends Exception
{
    protected $message = 'You are not authorized to perform this action.';

    /** @var int */
    protected $code = 403;

    public function render(): JsonResponse
    {
        return ExceptionResource::make(['body' => [$this->getMessage()]])
            ->response()
            ->setStatusCode($this->getCode());
    }
}
