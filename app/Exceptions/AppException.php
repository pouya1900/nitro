<?php

namespace App\Exceptions;

use Throwable;

class AppException extends \Exception {

    protected $httpStatusCode;

    protected $responseCode;

    public function __construct(string $message = "", int $httpStatusCode = 400, int $responseCode = 1, int $code = 0, Throwable $previous = null)
    {
        $httpStatusCode = is_null($httpStatusCode) ? config('responseCode.badRequest') : $httpStatusCode;
        $responseCode = is_null($responseCode) ? config('responseCode.globalError') : $responseCode;

        parent::__construct($message, $code, $previous);

        $this->responseCode = $responseCode;
        $this->httpStatusCode = $httpStatusCode;
    }

    public function getResponseCode() {
        return $this->responseCode;
    }

    public function getHttpStatusCode() {
        return $this->httpStatusCode;
    }
}
