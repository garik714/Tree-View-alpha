<?php

namespace App\Repositories\Read\Content;

use App\Models\Content\Content;
use App\Services\Content\Dto\ShowContentDto;
use Illuminate\Database\Eloquent\Collection;

interface ContentReadRepositoryInterface
{
    public function show(ShowContentDto $dto): Content;
    public function getById(string $contentId, int $userId, array $relations = []): Content;
    public function getRootContent(int $userId): Collection;
    public function getByIds(string $contentId, int $userId, string $parentId, string $oldParentId): Collection|array;
}
