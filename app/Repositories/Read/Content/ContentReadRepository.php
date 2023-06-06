<?php

namespace App\Repositories\Read\Content;

use App\Exceptions\ContentDoesNotExistException;
use App\Models\Content\Content;
use App\Services\Content\Dto\ShowContentDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ContentReadRepository implements ContentReadRepositoryInterface
{
    public function show(ShowContentDto $dto): Content
    {
        $query = $this->query();
        $query->where('user_id', $dto->userId);
        $query->where('id', $dto->rootId);
        $rootContent = $query->with(['children'])->first();

        if (is_null($rootContent)) {
            throw new ContentDoesNotExistException();
        }

        return $rootContent;
    }

    public function getById(string $contentId, int $userId, array $relations = []): Content
    {
        $query = $this->query();
        $query->with($relations);
        $query->where('user_id', $userId);
        $content = $query->where('id', $contentId)->first();

        if (is_null($content)) {
            throw new ContentDoesNotExistException();
        }

        return $content;
    }

    public function getRootContent(int $userId): Collection
    {
        $query = $this->query();
        $query->where('user_id', $userId);
        $query->where('is_root', true);

        return $query->get();
    }

    public function getByIds(string $contentId, int $userId, string $parentId, string $oldParentId): Collection|array
    {
        $query = $this->query();
        $query->where('user_id', $userId);
        $query->whereIn('id', [$contentId, $parentId, $oldParentId]);

        return $query->with('children')->withCount('children')->get();
    }

    private function query(): Builder
    {
        return Content::query();
    }
}
