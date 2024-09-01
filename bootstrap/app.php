<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e) {
        if($e instanceOf NotFoundHttpException) {
            return response()->Json(['error' =>  ['message' => 'There Is error'] ],404);
        } else {
            return response()->Json(['error' =>  ['message' => 'There Is error'] ],'??');
        }
        });
    })->create();
