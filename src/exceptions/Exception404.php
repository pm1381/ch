<?php

namespace App\Exceptions;

use Exception;
use App\Helpers\Tools;
use App\Classes\Response;

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
        Response::setStatus(404, '404 page not found');
    }
}