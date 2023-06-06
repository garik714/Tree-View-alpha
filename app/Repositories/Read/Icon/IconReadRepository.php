<?php

namespace App\Repositories\Read\Icon;

use App\Exceptions\IconDoesNotExistException;
use App\Models\Icon\Icon;
use App\Services\Icon\Dto\IndexIconDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class IconReadRepository implements IconReadRepositoryInterface
{
    public function index(IndexIconDto $dto): LengthAwarePaginator
    {
        $query = $this->query();

        $query->where('user_id', null);
        $query->orWhere('user_id', $dto->userId);

        return $query->paginate(
            $dto->pagination['perPage'],
            ['*'],
            'page',
            $dto->pagination['page']
        );
    }

    public function getById($id): Icon
    {
        $query = Icon::query();
        $icon = $query->where('id', $id)->first();

        if (is_null($icon)) {
            throw new IconDoesNotExistException();
        }

        return $icon;
    }

    public function getRootIcon(): Icon
    {
        $query = Icon::query();

        return $query->first();
    }

    private function query(): Builder
    {
        return Icon::query();
    }
}
