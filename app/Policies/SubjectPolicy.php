<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
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

    public function delete(User $user, Subject $subject)
    {
        return false;
    }

    public function isAdmin($user): Bool
    {
        return $user->is_admin;
    }
}
