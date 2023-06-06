<?php

namespace App\Services\Content\Dto;

use App\Http\Requests\Content\ContentRequest;
use Spatie\DataTransferObject\DataTransferObject;

class ContentDto extends DataTransferObject
{
    public string|null $parentId;
    public string $iconId;
    public bool $droppable;
    public bool $isRoot;
    public bool $hasChild;
    public string $name;
    public ?string $value;
    public int $userId;
    public int $sequence;

    public static function fromRequest(ContentRequest $request): self
    {
        return new self(
            parentId: $request->getParentId(),
            iconId: $request->getIconId(),
            droppable: $request->getDroppable(),
            isRoot: $request->getIsRoot(),
            hasChild: $request->getHasChild(),
            name: $request->getName(),
            value: $request->getValue(),
            userId: $request->user()->id,
            sequence: 0
        );
    }
}
