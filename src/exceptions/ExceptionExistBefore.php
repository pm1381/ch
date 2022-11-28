<?php

namespace App\Exceptions;

use App\Helpers\Tools;
use Exception;

class ExceptionExistBefore extends Exception {
    
    public function __construct($message){
        
    }

    public function report($error)
    {
        
    }

    public function render(array $request, $error)
    {
        print_f("ERROR : ");
        print_f($error);
        print_f("REQUEST : ");
        print_f($request);
    }
}