<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use App\Core\Exceptions\Resources\ExceptionResource;
use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{
    protected $message = 'Resource not found.';

    /** @var int */
    protected $code = 404;

    public function render(): JsonResponse
    {
        return ExceptionResource::make(['body' => [$this->getMessage()]])
            ->response()
            ->setStatusCode($this->getCode());
    }
}
