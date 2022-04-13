<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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


    public function render($request, Throwable $e)
    {
        if (env('SHOW_EXCEPTION', false)) {
            return parent::render($request, $e);
        }

        if ($request->isJson()) {
            return $this->customeApiExceptionHandle($e);
        }

        if ($e instanceof AppException) {
            $error = $e->getMessage();
            $httpStatusCode = $e->getHttpStatusCode();
            $responseCode = config('responseCode.globalError');

            return $this->sendError($error, $httpStatusCode, $responseCode);
        }


        return parent::render($request, $e);
    }

    public function customeApiExceptionHandle($exception)
    {
        $error = trans('api/messages.responseFailed');
        $httpStatusCode = config('responseCode.serverError');
        $responseCode = config('responseCode.globalError');

        switch (true) {
            case $exception instanceof ValidationException:
                $error = $exception->errors()[array_key_first($exception->errors())][0];
                $httpStatusCode = config('responseCode.validationFail');
                break;

            case $exception instanceof NotFoundHttpException:
                $error = 'متاسفانه url موردنظر موجود نمی باشد';
                $httpStatusCode = config('responseCode.notFound');
                break;

            case $exception instanceof ModelNotFoundException:
                $error = trans('api/messages.modelNotFound');
                $httpStatusCode = config('responseCode.notFound');
                break;

            case $exception instanceof AppException:
                $error = $exception->getMessage();
                $httpStatusCode = $exception->getHttpStatusCode();
                break;

            case $exception->getCode() == config('responseCode.validationFail'):
                $error = $exception->getMessage();
                $httpStatusCode = config('responseCode.validationFail');
                break;
        }

        return $this->sendError($error, $httpStatusCode, $responseCode);
    }
}
