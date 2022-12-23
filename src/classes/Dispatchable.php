<?php

namespace App\Classes;

use ReflectionClass;

trait Dispatchable
{
    private $event;

    private static $listeners;

    private static $subscribe;

    /**
     * Set the value of listeners
     *
     * @return  self
     */ 
    public function setListeners($listeners)
    {
        self::$listeners = $listeners;
        return $this;
    }

    /**
     * Set the value of subscribe
     *
     * @return  self
     */ 
    public function setSubscribe($subscribe)
    {
        self::$subscribe = $subscribe;
        return $this;
    }

    public  function dispatch()
    {
        foreach (self::$listeners as $listen) {
            $r = new ReflectionClass($listen);
            $r->newInstance()->handle($this);
        }
    }
}