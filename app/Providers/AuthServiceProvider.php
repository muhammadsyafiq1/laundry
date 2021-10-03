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

        Gate::define('isAdmin', function($user){
            return $user->roles == '1' ;
        });

        Gate::define('isPemilik', function($user){
            return $user->roles == '2';
        });

        Gate::define('isCustomer', function($user){
            return $user->roles == '3';
        });

        Gate::define('isPemilikAndAdmin', function($user){
            return $user->roles == '2' || $user->roles == '1';
        });
    }
}
