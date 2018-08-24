<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function authorize($user)
    {
        if ($user->is_admin) {
            return true;
        }
        return false;
    }
}
