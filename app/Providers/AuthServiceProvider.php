<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\User;
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

        /* define an admin user role */
        Gate::define('isAdmin',function($user){
            return $user->role == 'admin';
        });

        /* define an editor user role */
        Gate::define('isEditor',function($user){
            return $user->role == 'editor';
        });

        /* define an admin user role */
        Gate::define('isAuthor',function($user){
            return $user->role == 'author';
        });

        /* define an admin user role */
        Gate::define('isUser',function($user){
            return $user->role == 'user';
        });

        Gate::define('create-article', function (User $user, Article $article) {
            return $user->id === $article->user_id;
        });
    }
}
