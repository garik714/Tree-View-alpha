<?php

namespace App\Services\User\Actions;


use App\Models\User\User;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Services\User\Dto\CreateUserDto;

class CreateUserAction
{
    protected UserWriteRepositoryInterface $userWriteRepository;


    public function __construct(
        UserWriteRepositoryInterface $userWriteRepository,
    ) {
        $this->userWriteRepository = $userWriteRepository;
    }

    public function run(CreateUserDto $dto): User
    {
        $user = User::staticCreate($dto);
        $this->userWriteRepository->save($user);
        return $user;
    }
}
