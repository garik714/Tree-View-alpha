<?php

namespace App\Services\Icon\Dto;

use App\Http\Requests\Icon\IndexIconRequest;
use Spatie\DataTransferObject\DataTransferObject;

class IndexIconDto extends DataTransferObject
{
    public int $userId;
    public array $pagination;

    public static function fromRequest(IndexIconRequest $request): self
    {
        return new self(
            userId: $request->user()->id ?? 2,
            pagination: [
                'page' => $request->getPage(),
                'perPage' => $request->getPerPage(),
            ]
        );
    }
}
