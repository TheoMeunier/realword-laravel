<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use App\Core\Exceptions\Resources\ExceptionResource;
use Exception;
use Illuminate\Http\JsonResponse;

class InvalidCredentialsException extends Exception
{
    protected $message = 'Invalid credentials provided.';

    /** @var int */
    protected $code = 401;

    public function render(): JsonResponse
    {
        return ExceptionResource::make(['body' => [$this->getMessage()]])
            ->response()
            ->setStatusCode($this->getCode());
    }
}
