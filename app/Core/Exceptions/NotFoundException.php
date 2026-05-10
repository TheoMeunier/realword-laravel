<?php

namespace App\Core\Exceptions;

use App\Core\Exceptions\Resources\ExceptionResource;
use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{
    protected $code = 404;

    public function render(): JsonResponse
    {
        return ExceptionResource::make()->response()->setStatusCode($this->getCode());
    }
}

