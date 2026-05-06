<?php

namespace App\Core\Exceptions;

use App\Core\Exceptions\Resources\ExceptionResource;
use Exception;
use Illuminate\Http\JsonResponse;

class InvalidCredentialsException extends Exception
{
    protected $message = 'Invalid credentials provided.';
    protected $code = 401;

    public function render(): JsonResponse
    {
        return ExceptionResource::make([
            'code'    => $this->getCode(),
            'message' => $this->getMessage(),
            'type'    => class_basename($this),
        ])->response()->setStatusCode($this->getCode());
    }
}

