<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

abstract class BusinessLogicException extends Exception
{
    const SAVING_ERROR = 600;
    const CONTENT_DOES_NOT_EXIST = 601;
    const ICON_DOES_NOT_EXIST = 602;
    CONST USER_NOT_FOUND = 603;
    CONST DELETE_ERROR = 604;

    private int $httpStatusCode = Response::HTTP_BAD_REQUEST;

    abstract public function getStatus(): int;
    abstract public function getStatusMessage(): string;

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}
