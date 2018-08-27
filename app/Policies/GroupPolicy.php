<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    public function create(User $user)
    {
        return false;
    }

    public function delete(Group $group)
    {
        return false;
    }

    public function update()
    {
        return false;
    }
}
