<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mark;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarkPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->is_admin) {
            return true;
        }
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Mark $mark)
    {
        return false;
    }
}
