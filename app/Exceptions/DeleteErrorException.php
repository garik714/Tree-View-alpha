<?php

namespace App\Exceptions;

class DeleteErrorException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::DELETE_ERROR;
    }

    public function getStatusMessage(): string
    {
        return __('errors.saving_error');
    }
}
