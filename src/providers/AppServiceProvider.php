<?php
namespace App\Providers;

use App\Interfaces\Provider;
use App\Policies\HandleAuthorization;

class AuthServiceProvider implements Provider {
    public function register()
    {
        $handleAuth = new HandleAuthorization();
        $handleAuth->registerPolicies();
    }

    public function boot()
    {
        
    }
}
