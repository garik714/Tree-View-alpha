<?php

namespace App\Repositories\Write\Content;

use App\Exceptions\ContentDoesNotExistException;
use App\Exceptions\DeleteErrorException;
use App\Exceptions\SavingErrorException;
use App\Models\Content\Content;
use Illuminate\Database\Eloquent\Builder;

class ContentWriteRepository implements ContentWriteRepositoryInterface
{
    public function  save(Content $content): Content
    {
        if (!$content->save())
        {
            throw new SavingErrorException();
        }

        return $content;
    }

    public function delete(string $contentId): bool
    {
        $query = $this->query();

        if(!$query->where('id', $contentId)->delete())
        {
            throw new DeleteErrorException;
        }
        return true;
    }

    public function updateSequence(int $sequence, string $contentId): void
    {
        $query = $this->query();
        $query->where('id', $contentId);
        $query->update(['sequence'=> $sequence + 1]);
    }

    private function query(): Builder
    {
        return Content::query();
    }
}
