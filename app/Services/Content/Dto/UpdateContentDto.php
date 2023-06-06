<?php

namespace App\Services\Content\Dto;

use App\Http\Requests\Content\UpdateContentRequest;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateContentDto extends DataTransferObject
{
    public string $id;
    public ContentDto $contentDto;

    public static function fromRequest(UpdateContentRequest $request): self
    {
        return new self(
            id: $request->getId(),
            contentDto: ContentDto::fromRequest($request)
        );
    }
}
