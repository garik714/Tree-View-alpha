<?php

namespace App\Exceptions;

use App\Notifications\SlackNotification;
use App\Vendor\Sentry\RateLimitExceededException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Http\Response;

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



    public function render($request, Throwable $exception)
    {
        $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        $statusCode =  $exception->getCode();
        $details = [
            'message' => $exception->getMessage(),
        ];

        if ($exception instanceof ValidationException) {
            $httpCode = Response::HTTP_UNPROCESSABLE_ENTITY;
            $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
            $details['message'] = $exception->getMessage();

            foreach ($exception->errors() as $key => $error) {
                $details['errors'][$key] = $error[0] ?? 'Unknown error';
            }
        }

        if ($exception instanceof AuthenticationException) {
            $httpCode = Response::HTTP_UNAUTHORIZED;
            $statusCode = Response::HTTP_FORBIDDEN;
            $details['message'] = 'Unauthenticated';
        }

        if ($exception instanceof BusinessLogicException) {
            $httpCode = $exception->getHttpStatusCode();
            $statusCode = $exception->getStatus();
            $details['message'] = $exception->getStatusMessage();
        }

        $data = [
            'status' => $statusCode,
            'errors' => $details,
        ];

        return response()->json($data, $httpCode);
    }

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
           //
        });
    }
}
