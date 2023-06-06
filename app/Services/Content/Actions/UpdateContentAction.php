<?php

namespace App\Services\Content\Actions;

use App\Http\Resources\Content\ContentResource;
use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Repositories\Write\Content\ContentWriteRepositoryInterface;
use App\Services\Content\Dto\UpdateContentDto;
use Exception;

class UpdateContentAction
{
    protected ContentReadRepositoryInterface $contentReadRepository;
    protected ContentWriteRepositoryInterface $contentWriteRepository;

    public function __construct(
        ContentReadRepositoryInterface $contentReadRepository,
        ContentWriteRepositoryInterface $contentWriteRepository
    ) {
        $this->contentReadRepository = $contentReadRepository;
        $this->contentWriteRepository = $contentWriteRepository;
    }

    public function update(UpdateContentDto $dto): ContentResource
    {
        try {
            $content = $this->contentReadRepository->getById($dto->id, $dto->contentDto->userId);
            $content->updateByApi($dto);
            $this->contentWriteRepository->save($content);
        } catch (Exception $exception) {
            throw $exception;
        }

        return new ContentResource($content);
    }
}
