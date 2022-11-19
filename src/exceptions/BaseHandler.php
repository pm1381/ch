<?php

namespace App\Exceptions;

use Monolog\Logger;
use App\Classes\Date;
use App\Helpers\Input;
use App\Helpers\Tools;
use Exception;
use Monolog\Handler\StreamHandler;
use TypeError;
use Whoops\Exception\ErrorException;

class BaseHandler {
    protected array $dontReport = [
        
    ];

    protected array $dontFlash = [

    ];
    // it will be the name of those inputs you want to be flashed

    public function __construct(){}
    
    public function report($error)
    {
        if (! $this->shoulntReport($error)) {
            // print_f($error, true);
            if (! $this->manageReport($error)) {
                $baseLogger = new Logger('base');
                $date = Date::getCurrentDate();
                $baseLogger->pushHandler(new StreamHandler(Tools::slashToBackSlash(STORAGE . "log/" . $date . ".log")));
                $baseLogger->error(" *message : " . $error->getMessage() . " *File : " . $error->getFile() . " *Line : " . $error->getLine());
            }          
        }   
    }

    public function render(array $data, $error)
    {
        if (! $this->shoulntReport($error)) {
            if (! $this->manageRender($error)) {
                var_dump($data);
                var_dump($error);
            }
        }
    }

    private function manageReport($error)
    {
        if ($error instanceof Exception) {
            if (method_exists($error, 'report')) {
                $error->report($error);
                return true;
            }
        }
        return false;
    }

    private function manageRender($error)
    {
        if ($error instanceof Exception) {
            if (method_exists($error, 'render')) {
                $error->render(Input::getDataForm(), $error);
                return true;
            }
        }
        return false;
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