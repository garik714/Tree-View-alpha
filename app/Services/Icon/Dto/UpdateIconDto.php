<?php

namespace App\Services\Icon\Dto;

use App\Http\Requests\Icon\UpdateIconRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateIconDto extends DataTransferObject
{
    public string $id;
    public IconDto $iconDto;

    public static function fromRequest(UpdateIconRequest $request): self
    {
        return new self(
            id: $request->getId(),
            iconDto: IconDto::fromRequest($request)
        );
    }
}
