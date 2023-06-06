<?php

namespace App\Services\Icon\Actions;

use App\Repositories\Write\Icon\IconWriteRepositoryInterface;
use Exception;

class DeleteIconAction
{
    protected IconWriteRepositoryInterface $iconWriteRepository;

    public function __construct(
        IconWriteRepositoryInterface $iconWriteRepository
    ) {
        $this->iconWriteRepository = $iconWriteRepository;
    }

    public function delete(string $iconId): bool
    {
        try {
            $this->iconWriteRepository->delete($iconId);
        } catch (Exception $exception) {
            throw $exception;
        }

        return true;
    }
}
