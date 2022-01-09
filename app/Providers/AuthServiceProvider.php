<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('edit-post', function($user, $post){
            return $user->id == $post->user_id;
        });

        $gate->define('delete-post', function($user, $post){
			if ($user->hasRole('admin')){
				return true;
			}
            return $user->id == $post->user_id;
        });

		$gate->define('is-admin', function($user){
			return $user->hasRole('admin');
		});
    }
}
