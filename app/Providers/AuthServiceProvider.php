<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Models\Story;
use App\Policies\CommentPolicy;
use App\Policies\StoryPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Comment::class => CommentPolicy::class,
        Story::class => StoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function ($user) {
            return $user->roles_id == config('ad.admin');
        });

        Gate::define('is-inspector', function ($user) {
            return $user->roles_id == config('ad.inspector');
        });

        Gate::define('is-user', function ($user) {
            return $user->roles_id == config('ad.user');
        });

        Gate::define('is-active', function ($user) {
            return $user->status == config('ad.one');
        });
    }
}
