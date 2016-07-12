<?php

namespace ListIt\Providers;

use ListIt\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot() {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->header('X-APIToken')) {
                return \ListIt\User::where('APIToken', $request->header('X-APIToken'))->first();
            }  
            else if($request->session()->get('api-token')) {
                return \ListIt\User::where('APIToken', $request->session()->get('api-token'))->first();
            }
            else {
                return redirect('login');
            }
                
                
            /*
            if ($request->input('APIToken')) {
                return \ListIt\User::where('APIToken', $request->input('APIToken'))->first();
            }    */ 
                        
        });
    }

    

}
