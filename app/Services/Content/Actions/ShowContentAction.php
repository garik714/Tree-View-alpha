<?php

namespace App\Services\Content\Actions;

use App\Http\Resources\Content\ContentResource;
use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Services\Content\Dto\ShowContentDto;

class ShowContentAction
{
    protected ContentReadRepositoryInterface $contentReadRepository;

    public function __construct
    (
        ContentReadRepositoryInterface $contentReadRepository,
    ) {
        $this->contentReadRepository = $contentReadRepository;
    }

    public function show(ShowContentDto $dto): ContentResource
    {
        $result = $this->contentReadRepository->show($dto);

       return new ContentResource($result);
    }
}
