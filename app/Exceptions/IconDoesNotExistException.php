<?php

namespace App\Exceptions;

class IconDoesNotExistException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::ICON_DOES_NOT_EXIST;
    }

    public function getStatusMessage(): string
    {
        return __('errors.icon_does_not_exist');
    }
}
