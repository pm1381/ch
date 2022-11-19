<?php

namespace App\Exceptions;

use Monolog\Logger;
use App\Classes\Date;
use App\Helpers\Tools;
use Monolog\Handler\StreamHandler;
use TypeError;
use Whoops\Exception\ErrorException;

class BaseHandler {
    protected array $dontReport = [
        
    ];

    public function __construct(){}
    
    public function report($error)
    {
        if (! $this->shoulntReport($error)) {
            $baseLogger = new Logger('base');
            $date = Date::getCurrentDate();
            $baseLogger->pushHandler(new StreamHandler(Tools::slashToBackSlash(STORAGE . "log/" . $date . ".log")));
            $baseLogger->error(" *message : " . $error->getMessage() . " *File : " . $error->getFile() . " *Line : " . $error->getLine());
        }   
    }

    public function render(array $data, $error)
    {
        if (! $this->shoulntReport($error)) {
            var_dump($error);
        }
    }

    private function shoulntReport($checkError)
    {
        foreach ($this->dontReport as $errorClass) {
            if ($checkError instanceof $errorClass) {
                return true;
            }
        }
    }
}