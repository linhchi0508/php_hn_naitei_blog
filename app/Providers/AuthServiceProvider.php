<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('story', function ($user, $story) {
            return $user->id == $story->users_id;
        });

        Gate::define('is-admin', function ($user) {
            return $user->roles_id == config('ad.admin');
        });

        Gate::define('is-inspector', function ($user) {
            return $user->roles_id == config('ad.inspector');
        });

        Gate::define('is-user', function ($user) {
            return $user->roles_id == config('ad.user');
        });
    }
}
