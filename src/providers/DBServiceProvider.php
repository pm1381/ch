<?php
namespace App\Providers;

use App\Interfaces\Provider;
use App\Database\Database;

class DBServiceProvider implements Provider {
    public function register()
    {
        $mysqldatabase = new Database;
        $mysqldatabase->addMysqlConnection();
    }

    public function boot()
    {
        
    }
}

