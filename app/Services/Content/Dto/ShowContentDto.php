<?php

namespace App\Services\Content\Dto;

use App\Http\Requests\Content\ShowContentRequest;
use Spatie\DataTransferObject\DataTransferObject;

class ShowContentDto extends DataTransferObject
{
    public int $userId;
    public string $rootId;

    public static function fromRequest(ShowContentRequest $request): self
    {
        return new self(
            userId: $request->user()->id,
            rootId: $request->getId(),
        );
    }
}
