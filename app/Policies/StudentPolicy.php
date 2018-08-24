<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
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
