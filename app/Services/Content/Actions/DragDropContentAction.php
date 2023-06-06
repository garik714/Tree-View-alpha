<?php

namespace App\Services\Content\Actions;

use App\Http\Resources\Content\ContentResource;
use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Repositories\Write\Content\ContentWriteRepositoryInterface;
use App\Services\Content\Dto\DragDropContentDto;

class DragDropContentAction
{
    protected ContentReadRepositoryInterface $contentReadRepository;
    protected ContentWriteRepositoryInterface $contentWriteRepository;

    public function __construct(
        ContentReadRepositoryInterface $contentReadRepository,
        ContentWriteRepositoryInterface $contentWriteRepository,
    ) {
        $this->contentReadRepository = $contentReadRepository;
        $this->contentWriteRepository = $contentWriteRepository;
    }
    public function dragDrop(DragDropContentDto $dto)
    {
        try {
            $contents = $this->contentReadRepository->getByIds($dto->id, $dto->userId, $dto->parentId, $dto->oldParentId);

            foreach ($contents as $content)
            {
                if($content->id === $dto->id) {
                    $content->updateParentId($dto->parentId);
                }

                if($content->id === $dto->oldParentId && $content->children_count === 1) {
                    $content->updateHasChild(false);
                }

                if($content->id === $dto->parentId && $content->children_count === 0)
                {
                    $content->updateHasChild(true);
                }
                $this->contentWriteRepository->save($content);
            }

            return ContentResource::collection($contents)->resource->toArray();

        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
