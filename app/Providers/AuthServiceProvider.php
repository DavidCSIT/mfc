<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Recipe;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-recipe', function (User $user, Recipe $recipe) {
            return $recipe->user->is($user);
        });

        Gate::define('admin', function (User $user) {
            return $user->admin;
        });

        Gate::define('admin-family', function (User $user, User $member) {
            if ($user->admin  && $user->family_id == $member->family_id && $user->id != $member->id)
                return true;
            else
                return false;
        });
    }
}
