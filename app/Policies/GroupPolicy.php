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
        return $this->isAdmin($user);
    }

    public function create(User $user)
    {
        return false;
    }

    public function delete(User $user, Group $group)
    {
        return false;
    }

    public function update(User $user, Group $group)
    {
        return false;
    }

    public function isAdmin($user): Bool
    {
        return $user->is_admin;
    }

}
