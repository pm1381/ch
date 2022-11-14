<?php

namespace App\Controllers\MiddleWares\Site;

use App\Controllers\MiddleWares\Refrence\GeneralMiddleWare;
use App\Helpers\Tools;

class UserMiddleWare extends GeneralMiddleWare {
    public function numCheck(...$inputs) {
        foreach ($inputs as $input) {
            if (! is_numeric($input)) {
                // $router->trigger404();
                
                // http_response_code(404);
                // exit();
                
                Tools::throw404();
                exit();

                // redirect can be helpful also
            }
        }
    }
}