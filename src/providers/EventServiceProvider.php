<?php
namespace App\Providers;

use App\Events\PasswordChange;
use App\Interfaces\Provider;
use App\Listeners\PasswordMail;
use ReflectionClass;

class EventServiceProvider extends ServiceProvider implements Provider {

    private $listens = [
        PasswordChange::class => [
            PasswordMail::class
        ]
    ];

    private $subscribes = [];
    
    public function register()
    {
        foreach ($this->listens as $event => $listeners) {
            $r = new ReflectionClass($event);
            $eventInstance = $r->newInstance();
            $eventInstance->setListeners($listeners);

            if (array_key_exists($event, $this->subscribes)) {
                $eventInstance->setSubscribe($this->subscribes[$event]);
            }
        }
    }

    public function boot()
    {
        
    }
}
