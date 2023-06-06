<?php

namespace App\Services\Content\Actions;

use App\Http\Resources\Content\ContentParentResource;
use App\Http\Resources\Content\ContentResource;
use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Repositories\Write\Content\ContentWriteRepositoryInterface;
use App\Services\Content\Dto\DeleteContentDto;
use Exception;
use function PHPUnit\Framework\isEmpty;

class DeleteContentAction
{
    public function __construct(
        protected ContentWriteRepositoryInterface $contentWriteRepository,
        protected ContentReadRepositoryInterface $contentReadRepository
    ) { }

    public function delete(DeleteContentDto $dto): ContentParentResource
    {
        $content = $this->contentReadRepository->getById($dto->contentId, $dto->userId);

        $this->contentWriteRepository->delete($content->id);

        $parent = $this->contentReadRepository->getById($content->parent_id, $dto->userId, ['children']);

        if ($parent->children->isEmpty()) {
            $parent->has_child = false;

            $this->contentWriteRepository->save($parent);
        }

        return new ContentParentResource($parent);
    }
}
