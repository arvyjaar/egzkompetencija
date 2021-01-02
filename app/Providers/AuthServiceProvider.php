<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is_admin', function ($user) {
            return
                $user->roles->contains('title', 'Admin');
        });

        Gate::define('report_edit_delete', function ($user, $report) {
            return
                ($user->id === $report->observer_id) || $user->roles->contains('title', 'Manager');
        });

        Gate::define('report_show', function ($user, $report) {
            return
                ($user->id === $report->employee_id)
                ||
                ($user->id === $report->observer_id)
                ||
                $user->roles->contains('title', 'Manager');
        });

        Gate::define('report_comment', function ($user, $report) {
            return
                ($user->id === $report->employee_id)
                ||
                $user->roles->contains('title', 'Manager');
        });
    }
}
