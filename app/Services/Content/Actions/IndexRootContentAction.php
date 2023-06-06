<?php

namespace App\Services\Content\Actions;

use App\Http\Resources\Content\ContentResource;
use App\Http\Resources\Icon\RootIconResource;
use App\Repositories\Read\Content\ContentReadRepositoryInterface;
use App\Repositories\Read\Icon\IconReadRepositoryInterface;

class IndexRootContentAction
{
    protected ContentReadRepositoryInterface $contentReadRepository;
    protected IconReadRepositoryInterface $iconReadRepository;

    public function __construct
    (
        ContentReadRepositoryInterface $contentReadRepository,
        IconReadRepositoryInterface $iconReadRepository
    ) {
        $this->contentReadRepository = $contentReadRepository;
        $this->iconReadRepository = $iconReadRepository;
    }

    public function index(int $userId): array
    {
        $rootContents = $this->contentReadRepository->getRootContent($userId);
        $rootIcon = $this->iconReadRepository->getRootIcon();

        $returnData ['data'] = ContentResource::collection($rootContents)->resource->toArray();
        $returnData ['rootIcon'] = $rootIcon->id;

        return $returnData;
    }
}
