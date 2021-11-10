<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Comment;
use Auth;

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

        // Recipe is my recipe or user is admin of my family
        Gate::define('update-recipe', function (User $user, Recipe $recipe) {
            if ($recipe->user->is($user))
                return true;
            else if ($user->admin  && $recipe->user->family->is($user->family))
                return true;
            else
                return false;
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

        // Can delete comments 
        Gate::define('Delete-Comment', function (User $user, Comment $comment) {
             //my comment         
            if ($user->id == $comment->user->id)
                return true;
            //my recipe
            elseif ($user->id == $comment->recipe->user_id)
                 return true;
            // user is admin
            elseif ($user->admin && $user->family_id == $comment->user->family_id)
                return true;
            else
                return false;
            

        });
    }
}
