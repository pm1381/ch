<?php

namespace App\Exceptions;

use App\Helpers\Tools;
use Exception;

class ExceptionMail extends Exception {
    
    public function __construct($message){
        
    }

    public function report($error)
    {
        //action that must be provided;
    }

    public function render(array $request, $error)
    {
        $message = 'error is happend while trying to send email . error = ' . $error->getMessage();
        Tools::setStatus(400, $message);
    }
}