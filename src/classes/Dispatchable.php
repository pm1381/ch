<?php

namespace App\Classes;

use Exception;
use ReflectionClass;
use ReflectionMethod;

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

    public  function dispatch(...$arguments)
    {
        foreach (self::$listeners as $listen) {
            $modelConstructor = new ReflectionMethod($this, '__construct');
            $numOfParams = $modelConstructor->getNumberOfParameters();
            if (count($numOfParams) != count($arguments)) {
                throw new Exception("number of arguments for construct method does not match");
            }
            $newInstance = (new ReflectionClass($this))->newInstanceArgs($arguments);
            $listen->handle($newInstance);
        }
    }
}