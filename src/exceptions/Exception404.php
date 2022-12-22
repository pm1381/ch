<?php

namespace App\Exceptions;

use App\Helpers\Tools;
use Exception;

class Exception404 extends Exception {
    
    public function __construct($message){
        
    }

    public function report($error)
    {
        header('HTTP/1.1 404 Not Found');
    }

    public function render(array $request, $error)
    {
        // returning 404 view
        Tools::setStatus(404, '404 page not found');
    }
}