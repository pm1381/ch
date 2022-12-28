<?php

namespace App\Controllers\MiddleWares\Site;

use App\Entities\User;
use App\Controllers\MiddleWares\Refrence\GeneralMiddleWare;
use App\Exceptions\Exception404;
use App\Helpers\Tools;

class UserMiddleWare {
    public function numCheck(...$inputs) {
        $user = new User();
        if ($user->isLogin()['login']) {
            foreach ($inputs as $input) {
                if (! is_numeric($input)) {
                    throw new Exception404("404 error");
                }
            }
        } else {
            Tools::redirect(BASE_URI . '/register/');
        }
    }
}
