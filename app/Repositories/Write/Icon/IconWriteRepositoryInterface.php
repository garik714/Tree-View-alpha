<?php

namespace App\Repositories\Write\Icon;

use App\Models\Icon\Icon;

interface IconWriteRepositoryInterface
{
    public function save(Icon $icon): Icon;
    public function delete(string $iconId): bool;
}
