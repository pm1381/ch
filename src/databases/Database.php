<?php

namespace App\Databases;

use Illuminate\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as DB;
// use Phroute\Phroute\Dispatcher;

class Database {
    
    public function __construct(){}

    public function addConnection() {
        $db = new DB();
        $db->addConnection([
            'driver' => DRIVER,
            'host' => HOST_NAME,
            'database' => DB_NAME,
            'username' => USERNAME,
            'password' => PASSWORD,
            'charset' => 'utf8'
        ]);

        $db->setAsGlobal();
        // $db->setEventDispatcher(new Dispatcher(new Container));
        $db->bootEloquent();
    }
}