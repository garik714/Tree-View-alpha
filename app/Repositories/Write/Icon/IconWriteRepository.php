<?php

namespace App\Repositories\Write\Icon;

use App\Exceptions\IconDoesNotExistException;
use App\Exceptions\SavingErrorException;
use App\Models\Icon\Icon;

class IconWriteRepository implements IconWriteRepositoryInterface
{
    public function save(Icon $icon): Icon
    {
        if (!$icon->save())
        {
            throw new SavingErrorException();
        }

        return $icon;
    }

    public function delete(string $iconId): bool
    {
        $query = Icon::query();
        $query->where('id', $iconId);
        $icon = $query->first();

        if (is_null($icon)) {
            throw new IconDoesNotExistException();
        }

        $query->delete();

        return true;
    }
}
