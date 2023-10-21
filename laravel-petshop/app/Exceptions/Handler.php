<?php

namespace App\Exceptions;

use App\Http\Responses\ApiErrorResponse;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Exception|Throwable $e)
    {
        $response = parent::render($request, $e);
        if ($e instanceof AuthorizationException && $request->wantsJson()) {
            return new ApiErrorResponse(
                trans('auth.unauthorized'),
                Response::HTTP_FORBIDDEN,
                $e
            );
        }

        if ($e instanceof ModelNotFoundException && $request->wantsJson()) {
            return new ApiErrorResponse(
                trans('messages.not_found'),
                Response::HTTP_NOT_FOUND,
                $e
            );
        }

        return $response;
    }
}
