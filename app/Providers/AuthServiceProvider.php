<?php

namespace App\Providers;

use App\Auth\CustomUserProvider;
use App\Model\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->configure('auth');
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

//        $this->app['auth']->viaRequest('api', function ($request, array $config) {
////            return Usuario::where('login', $request->input('login'))->first();
//            new CustomUserProvider($request['login'], $config['model']);
//        });

        Auth::provider('custom-user', function ($request, array $config){
            return new CustomUserProvider($request['hash'], $config['model']);
        });
    }
}
