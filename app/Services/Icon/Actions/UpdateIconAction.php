<?php

namespace App\Services\Icon\Actions;

use App\Http\Resources\Icon\IconResource;
use App\Repositories\Read\Icon\IconReadRepositoryInterface;
use App\Repositories\Write\Icon\IconWriteRepositoryInterface;
use App\Services\Icon\Dto\UpdateIconDto;
use Exception;

class UpdateIconAction
{
    protected IconReadRepositoryInterface $iconReadRepository;
    protected IconWriteRepositoryInterface $iconWriteRepository;

    public function __construct(
        IconReadRepositoryInterface $iconReadRepository,
        IconWriteRepositoryInterface $iconWriteRepository
    ) {
        $this->iconReadRepository = $iconReadRepository;
        $this->iconWriteRepository = $iconWriteRepository;
    }

    public function update(UpdateIconDto $dto): IconResource
    {
        try {
            $icon = $this->iconReadRepository->getById($dto->id);
            $icon = $icon->updateByApi($dto);
            $this->iconWriteRepository->save($icon);
        } catch (Exception $exception) {
            throw $exception;
        }

        return new IconResource($icon);
    }
}
