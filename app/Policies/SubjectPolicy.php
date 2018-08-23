<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the subject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return mixed
     */
    public function view(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can create subjects.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the subject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return mixed
     */
    public function update(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can delete the subject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return mixed
     */
    public function delete(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can restore the subject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return mixed
     */
    public function restore(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the subject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return mixed
     */
    public function forceDelete(User $user, Subject $subject)
    {
        //
    }
}
