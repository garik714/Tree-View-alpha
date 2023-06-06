<?php

namespace App\Services\User\Dto;

use App\Http\Requests\RefreshTokenRequest;
use Spatie\DataTransferObject\DataTransferObject;

class RefreshTokenDto extends DataTransferObject
{
    public string $userId;
    public string $refreshToken;

    public static function fromRequest(RefreshTokenRequest $request): RefreshTokenDto
    {
        return new self(
            userId: $request->getUserId(),
            refreshToken: $request->getRefreshToken(),
        );
    }
}

