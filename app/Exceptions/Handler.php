<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

    //. The list of the inputs that are never flashed to the session on validation exceptions
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        //. Return exception from guard
        $guard = $exception->guards()[0] ?? null;
        if ($guard === 'api') {
            return $this->errorResponse('unauthenticated_jwt', 401);
        }
        if ($guard === 'oauth') {
            return $this->errorResponse('unauthenticated_oauth', 401);
        }
        return $this->errorResponse('unauthenticated_others', 401);
    }

    //! Catches all exceptions → returns standard JSON from the API.
    public function render($request, Throwable $e)
    {
        if ($e instanceof HttpExceptionInterface) {
            return $this->errorResponse(
                $e->getMessage() ?: 'HTTP error',
                $e->getStatusCode()
            );
        }

        return $this->errorResponse(
            $e->getMessage(),
            500
        );
    }

    // Register the exception handling callbacks for the application
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
