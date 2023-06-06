<?php

namespace App\Services\Content\Dto;

use App\Http\Requests\Content\DeleteContentRequest;
use Spatie\DataTransferObject\DataTransferObject;

class DeleteContentDto extends DataTransferObject
{
    public int $userId;
    public string $contentId;

    public static function fromRequest(DeleteContentRequest $request): self
    {
        return new self(
            userId: $request->user()->id,
            contentId: $request->getId(),
        );
    }
}
