<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mark;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the mark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mark  $mark
     * @return mixed
     */
    public function view(User $user, Mark $mark)
    {
        //
    }

    /**
     * Determine whether the user can create marks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the mark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mark  $mark
     * @return mixed
     */
    public function update(User $user, Mark $mark)
    {
        //
    }

    /**
     * Determine whether the user can delete the mark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mark  $mark
     * @return mixed
     */
    public function delete(User $user, Mark $mark)
    {
        //
    }

    /**
     * Determine whether the user can restore the mark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mark  $mark
     * @return mixed
     */
    public function restore(User $user, Mark $mark)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the mark.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mark  $mark
     * @return mixed
     */
    public function forceDelete(User $user, Mark $mark)
    {
        //
    }
}
