<?php

namespace App\Repositories\Write\User;

use App\Models\User\User;

class UserWriteRepository implements UserWriteRepositoryInterface {

    public function save(User $user): User
    {
        $user->save();
        return $user;
    }
}
