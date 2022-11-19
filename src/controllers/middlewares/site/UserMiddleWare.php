<?php

namespace App\Controllers\MiddleWares\Site;

use App\Classes\User;
use App\Controllers\MiddleWares\Refrence\GeneralMiddleWare;
use App\Exceptions\Handler404;
use App\Helpers\Tools;

class UserMiddleWare extends GeneralMiddleWare {
    public function numCheck(...$inputs) {
        $user = new User();
        if ($user->isLogin()) {
            foreach ($inputs as $input) {
                if (! is_numeric($input)) {
                    // http_response_code(404);
                    // exit();

                    $error404 = new Handler404();
                    $error404->reportError();
                    $error404->renderError([]);
                }
            }
        } else {
            Tools::redirect(BASE_URI . '/register/');
        }
    }
}