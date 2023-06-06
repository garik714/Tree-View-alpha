<?php

namespace App\Services\User\Dto;

use App\Http\Requests\RegisterRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateUserDto extends DataTransferObject
{
    public string $name;
    public string $surname;
    public string $username;
    public string $password;

    public static function fromRequest(RegisterRequest $request): CreateUserDto
    {
        return new self(
            name: $request->getName(),
            surname: $request->getSurname(),
            username: $request->getUsername(),
            password: $request->getPassword(),
        );
    }
}
