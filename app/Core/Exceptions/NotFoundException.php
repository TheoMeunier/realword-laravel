<?php

namespace App\Core\Exceptions;

use App\Core\Exceptions\Resources\ExceptionResource;
use Exception;
use Illuminate\Http\JsonResponse;

class NotFoundException extends Exception
{
    protected $message = 'Not found.';
    protected $code = 404;

    public function __construct(?string $message = null, ?int $code = null)
    {
        parent::__construct(
            $message ?? $this->message,
            $code ?? $this->code
        );
    }

    public function render(): JsonResponse
    {
        return ExceptionResource::make([
            'code'    => $this->getCode(),
            'message' => $this->getMessage(),
            'type'    => class_basename($this),
        ])->response()->setStatusCode($this->getCode());
    }
}

