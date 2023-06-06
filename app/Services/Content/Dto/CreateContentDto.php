<?php

namespace App\Services\Content\Dto;

use App\Http\Requests\Content\CreateContentRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateContentDto extends DataTransferObject
{
    public ContentDto $contentDto;

    public static function fromRequest(CreateContentRequest $request): self
    {
        return new self(
            contentDto: ContentDto::fromRequest($request)
        );
    }
}
