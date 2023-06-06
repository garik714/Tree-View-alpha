<?php

namespace App\Repositories\Read\User;

use App\Models\User\User;


interface UserReadRepositoryInterface {
    public function getByUsername(string $username): User;
    public function getById(int $userId): User;
}
