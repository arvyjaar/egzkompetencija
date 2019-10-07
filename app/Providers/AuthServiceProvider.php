<?php

namespace App\Providers;

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

        Gate::define('is-examiner', function ($user, $monitoringReport) {

            return $user->id === $monitoringReport->examiner_id;
        });

        Gate::define('is-observer', function ($user, $monitoringReport) {

            return $user->id === $monitoringReport->observer_id;
        });
    }
}
