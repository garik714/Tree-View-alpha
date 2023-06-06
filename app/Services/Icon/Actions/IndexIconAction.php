<?php

namespace App\Services\Icon\Actions;

use App\Http\Resources\Icon\IconResource;
use App\Repositories\Read\Icon\IconReadRepositoryInterface;
use App\Services\Icon\Dto\IndexIconDto;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexIconAction
{
    protected IconReadRepositoryInterface $iconReadRepository;

    public function __construct(
        IconReadRepositoryInterface $iconReadRepository
    ) {
        $this->iconReadRepository = $iconReadRepository;
    }

    public function index(IndexIconDto $dto): AnonymousResourceCollection
    {
        $icons = $this->iconReadRepository->index($dto);

        return IconResource::collection($icons);
    }
}
