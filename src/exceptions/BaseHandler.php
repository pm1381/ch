<?php

namespace App\Exceptions;

use Monolog\Logger;
use App\Classes\Date;
use App\Helpers\Tools;
use Monolog\Handler\StreamHandler;
use Whoops\Exception\ErrorException;

class BaseHandler {

    public function __construct(){}
    
    public function report($error)
    {
        $baseLogger = new Logger('base');
        $date = Date::getCurrentDate();
        $baseLogger->pushHandler(new StreamHandler(Tools::slashToBackSlash(STORAGE . "log/" . $date . ".log")));
        $baseLogger->error(" *message : " . $error->getMessage() . " *File : " . $error->getFile() . " *Line : " . $error->getLine());   
    }

    public function render(array $data, $error)
    {
        var_dump($error);
    }
}