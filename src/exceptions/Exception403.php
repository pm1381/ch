<?php

namespace App\Exceptions;

use App\Helpers\Tools;
use Exception;

class Exception403 extends Exception {
    
    public function __construct($message){
        
    }

    public function report($error)
    {
        header('HTTP/1.1 403 Unauthorized');
    }

    public function render(array $request, $error)
    {
        // returning 404 view
        Tools::setStatus(403, '403 unauthorized move');
    }
}