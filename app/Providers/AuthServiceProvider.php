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

        // Recipie is my recipe
        Gate::define('update-recipe', function (User $user, Recipe $recipe) {
            return $recipe->user->is($user);
        });

        // User is a admin of a family
        Gate::define('admin', function (User $user) {
            return $user->admin;
        });

        // User is admin of another user
        Gate::define('admin-family', function (User $user, User $member) {
            if ($user->admin  && $user->family_id == $member->family_id && $user->id != $member->id)
                return true;
            else
                return false;
        });

        // Recipe is my family cookbook
        Gate::define('Recipe-in-my-cookbook', function (User $user, Recipe $recipe) {
            return $recipe->user->family->is($user->family);
        });
    }
}
