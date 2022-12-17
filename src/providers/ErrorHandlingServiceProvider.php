<?php
namespace App\Providers;

use App\Interfaces\Provider;
use App\Exceptions\Handler;
use App\Helpers\Input;

class ErrorHandlingServiceProvider extends ServiceProvider implements Provider {
    public function register()
    {
        // other whoops handlers:
        // $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        // $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);

        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function($error) {
            $handler = new Handler();
            $handler->report($error);
            $handler->render(Input::getDataForm(), $error);
        }));
        $whoops->register();
    }

    public function boot()
    {
        
    }
}

