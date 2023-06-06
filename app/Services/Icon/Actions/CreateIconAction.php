<?php

namespace App\Services\Icon\Actions;

use App\Http\Resources\Icon\IconResource;
use App\Models\Icon\Icon;
use App\Repositories\Write\Icon\IconWriteRepositoryInterface;
use App\Services\Icon\Dto\CreateIconDto;
use Exception;

class CreateIconAction
{
    protected IconWriteRepositoryInterface $iconWriteRepository;

    public function __construct(
        IconWriteRepositoryInterface $iconWriteRepository
    ) {
        $this->iconWriteRepository = $iconWriteRepository;
    }

    public function create(CreateIconDto $dto): IconResource
    {
        try {
            $icon = Icon::create($dto);
            $this->iconWriteRepository->save($icon);
        } catch (Exception $exception) {
            throw $exception;
        }

        return new IconResource($icon);
    }
}
