<?php

namespace App\Repositories\Write\Content;

use App\Models\Content\Content;

interface ContentWriteRepositoryInterface
{
    public function save(Content $content): Content;
    public function delete(string $contentId): bool;
    public function updateSequence(int $sequence, string $contentId): void;
}
