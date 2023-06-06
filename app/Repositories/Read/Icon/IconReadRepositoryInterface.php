<?php

namespace App\Repositories\Read\Icon;

use App\Models\Icon\Icon;
use App\Services\Icon\Dto\IndexIconDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IconReadRepositoryInterface
{
    public function index(IndexIconDto $dto): LengthAwarePaginator;
    public function getById($id): Icon;
    public function getRootIcon() :Icon;
}
