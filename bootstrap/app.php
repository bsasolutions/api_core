<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // ApiException custom
        $exceptions->renderable(function (\App\Exceptions\ApiException $e, $request) {
            return (new \App\Exceptions\Renderers\ApiExceptionRenderer())->render($e, $request);
        });

        // HttpException 404, 403, 500
        $exceptions->renderable(function (HttpExceptionInterface $e, $request) {
            return response()->json([
                'message' => $e->getMessage() ?: 'HTTP error',
            ], $e->getStatusCode());
        });

        // Fallback custom
        $exceptions->renderable(function (\Throwable $e, $request) {
            if ($e instanceof HttpExceptionInterface) {
                return null; // deixa o handler acima responder
            }

            if ($e instanceof \App\Exceptions\ApiException) {
                return null; // deixa o handler acima responder
            }

            return (new \App\Exceptions\Renderers\FallbackExceptionRenderer())
                ->render($e, $request);
        });

        // Fallback 500
        $exceptions->renderable(function (\Throwable $e, $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        });
    })->create();
