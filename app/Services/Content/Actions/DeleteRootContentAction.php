<?php

namespace App\Services\Content\Actions;

use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Repositories\Write\Content\ContentWriteRepositoryInterface;
use App\Services\Content\Dto\DeleteContentDto;

class DeleteRootContentAction
{
    public function __construct(
        protected ContentWriteRepositoryInterface $contentWriteRepository,
        protected ContentReadRepositoryInterface $contentReadRepository
    ) { }

    public function delete(DeleteContentDto $dto): void
    {
        $this->contentWriteRepository->delete($dto->contentId);
    }
}
