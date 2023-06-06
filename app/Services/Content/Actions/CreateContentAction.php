<?php

namespace App\Services\Content\Actions;

use App\Http\Resources\Content\ContentResource;
use App\Models\Content\Content;
use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Repositories\Write\Content\ContentWriteRepositoryInterface;
use App\Services\Content\Dto\CreateContentDto;

class CreateContentAction
{
    public function __construct(
        protected ContentWriteRepositoryInterface $contentWriteRepository,
        protected ContentReadRepositoryInterface $contentReadRepository
    ) {
    }

    public function create(CreateContentDto $dto): ContentResource
    {
            $content = Content::create($dto);
            $this->contentWriteRepository->save($content);

            if(!is_null($content->parent))
            {
                $this->contentWriteRepository->updateSequence($content->parent->sequence, $content->id);
                $content->parent->has_child = true;
                $this->contentWriteRepository->save($content->parent);
                $content = $this->contentReadRepository->getById($content->id, $content->user_id, ['parent', 'icon']);
            }

        $content = $this->contentReadRepository->getById($content->id, $content->user_id, ['icon']);

        return new ContentResource($content);
    }
}
