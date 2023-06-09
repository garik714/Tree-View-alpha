<?php

namespace App\Exceptions;

class ContentDoesNotExistException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::CONTENT_DOES_NOT_EXIST;
    }

    public function getStatusMessage(): string
    {
        return __('errors.content_does_not_exist');
    }
}
