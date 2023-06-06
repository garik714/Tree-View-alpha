<?php

namespace App\Services\Content\Dto;

use App\Http\Requests\Content\DragDropContentRequest;
use Spatie\DataTransferObject\DataTransferObject;

class DragDropContentDto extends DataTransferObject
{
    public string $id;
    public string $oldParentId;
    public string $parentId;
    public int $userId;
    public ?bool $hasChild;

    public static function fromRequest(DragDropContentRequest $request): self
    {
        return new self(
            id: $request->getId(),
            oldParentId: $request->getOldParentId(),
            parentId: $request->getParentId(),
            userId: $request->user()->id,
            hasChild: false
        );
    }
}
