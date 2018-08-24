<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mark;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarkPolicy
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
