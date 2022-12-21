<?php

namespace App\Controllers\MiddleWares\Refrence;

use App\Services\User;

class GeneralMiddleWare {
    public function login()
    {
        $userService = new User();
        $current = $userService->isLogin();
        if ($current['login'] == false)
            exit();
    }
}
