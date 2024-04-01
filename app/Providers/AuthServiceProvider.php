<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate->define('upvote-post', function ($user, $post) {
            // Authorization logic to determine if the user can upvote the post
            return true; // Replace with your actual logic
        });
    }
}



