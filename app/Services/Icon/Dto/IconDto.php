<?php

namespace App\Services\Icon\Dto;

use App\Http\Requests\Icon\IconRequest;
use Spatie\DataTransferObject\DataTransferObject;

class IconDto extends DataTransferObject
{
    public string $source;
    public string $name;
    public ?int $userId;

    public static function fromRequest(IconRequest $request): self
    {
        return new self(
            source: env('APP_URL') . $request->getSource(),
            name: $request->getName(),
            userId: $request->user()->id,
        );
    }
}
