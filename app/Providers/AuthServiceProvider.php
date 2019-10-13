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

        Gate::define('report_edit_delete', function ($user, $monitoringReport) {
            return
                ($user->id === $monitoringReport->observer_id) || $user->roles->contains('title', 'EVPIS');
        });

        Gate::define('report_show', function ($user, $monitoringReport) {
            return
                ($user->id === $monitoringReport->examiner_id)
                ||
                ($user->id === $monitoringReport->observer_id)
                ||
                $user->roles->contains('title', 'EVPIS');
        });

        Gate::define('report_comment', function ($user, $monitoringReport) {
            return
                ($user->id === $monitoringReport->examiner_id)
                ||
                $user->roles->contains('title', 'EVPIS');
        });
    }
}
