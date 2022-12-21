<?php
namespace App\Providers;

use App\Classes\Session;
use App\Interfaces\Provider;
use App\Policies\HandleAuthorization;

class AppServiceProvider extends ServiceProvider implements Provider {
    public function register()
    {
        $session = new Session();
        $session->start();

        $handleAuth = new HandleAuthorization();
        $handleAuth->registerPolicies();
    }

    public function boot()
    {
        
    }
}
