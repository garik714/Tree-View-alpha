<?php

namespace App\Services\Icon\Dto;

use App\Http\Requests\Icon\CreateIconRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateIconDto extends DataTransferObject
{
    public IconDto $iconDto;

    public static function fromRequest(CreateIconRequest $request): self
    {
        return new self(
            iconDto: IconDto::fromRequest($request)
        );
    }
}
