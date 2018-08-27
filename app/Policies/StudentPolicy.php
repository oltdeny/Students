<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
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

    public function delete(User $user, Student $student)
    {
        return false;
    }

    public function show(Student $student)
    {
        return false;
    }

    public function update(Student $student)
    {
        return false;
    }

    public function addPhoto(Student $student)
    {
        return false;
    }
}
