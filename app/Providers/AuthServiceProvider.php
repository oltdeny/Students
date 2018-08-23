<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Policies\GroupPolicy;
use App\Policies\MarkPolicy;
use App\Policies\StudentPolicy;
use App\Policies\SubjectPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Group::class => GroupPolicy::class,
        Student::class => StudentPolicy::class,
        Subject::class => SubjectPolicy::class,
        Mark::class => MarkPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
