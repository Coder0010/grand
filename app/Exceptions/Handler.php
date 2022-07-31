<?php

namespace App\Exceptions;

use App;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (Throwable $e) {
            if (request()->wantsJson()) {
                switch ($e) {
                    case $e instanceof MethodNotAllowedHttpException:
                        return response()->json([
                            "message" => "method not allowed",
                        ], 405);
                        break;
                    case $e instanceof ModelNotFoundException:
                        return response()->json([
                            "message" => "record not found",
                        ], 404);
                        break;
                    case $e instanceof NotFoundHttpException:
                        return response()->json([
                            "message" => "route not found",
                        ], 404);
                        break;
                    case $e instanceof ValidationException:
                        return response()->json([
                            "message" => "failed validation",
                            "errors" => $e->errors()
                        ], 422);
                        break;
                    case $e instanceof AuthenticationException:
                        return response()->json([
                            "message" => "unauthenticated",
                        ], 401);
                        break;
                    case $e instanceof AuthorizationException:
                        return response()->json([
                            "message" => "unauthorized",
                        ], 403);
                        break;
                    case $e instanceof MaintenanceModeException:
                        return response()->json([
                            "message" => "maintenance mode",
                        ], 200);
                        break;
                    default:
                        return response()->json([
                            "message" => $e->getMessage(),
                        ], 500);
                        break;
                }
            }
        });
    }
}
