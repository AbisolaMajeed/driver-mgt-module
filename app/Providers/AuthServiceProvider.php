<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define gates for permissions
        Gate::define('manage-user-roles', function ($user) {
            return $user->role === 'super_admin';
        });

        Gate::define('manage-drivers', function ($user) {
            return in_array($user->role, ['admin', 'super_admin']);
        });

        Gate::define('view-data', function ($user) {
            return in_array($user->role, ['support_staff', 'admin', 'super_admin']);
        });
    }
}
