<?php

namespace App\Services\User\Actions;

use App\Models\User\User;

class LogoutAction
{
    public function run(User $user): void
    {
        $user->token()->revoke();
    }
}
