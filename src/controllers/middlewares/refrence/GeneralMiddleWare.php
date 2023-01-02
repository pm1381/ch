<?php

namespace App\Controllers\MiddleWares\Refrence;

use App\Entities\User;
use App\Helpers\Tools;

class GeneralMiddleWare {
    public function login()
    {
        $userService = new User();
        // login check using sessions;
        // $current = $userService->isLogin();

        //login check using jwt
        $current = $userService->isLoginJwt();
        if ($current['login'] == false)
            // Tools::redirect('/login/');
            exit();
    }
}
