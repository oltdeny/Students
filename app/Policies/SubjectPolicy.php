<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
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
