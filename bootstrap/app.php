<?php

declare(strict_types=1);

use App\Core\Exceptions\ForbiddenException;
use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\Resources\ExceptionResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ModelNotFoundException $e) {
            throw new NotFoundException;
        });

        $exceptions->render(function (AuthenticationException $e) {
            return ExceptionResource::make(['body' => ['Unauthenticated.']])
                ->response()
                ->setStatusCode(401);
        });

        $exceptions->render(function (AuthorizationException $e) {
            throw new ForbiddenException($e->getMessage());
        });

        $exceptions->render(function (ValidationException $e) {
            return ExceptionResource::make($e->errors())
                ->response()
                ->setStatusCode(422);
        });
    })->create();
