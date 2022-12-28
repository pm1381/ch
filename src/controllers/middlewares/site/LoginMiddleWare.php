<?php

namespace App\Controllers\MiddleWares\Site;

use App\Helpers\Tools;
use App\Classes\Response;
use App\Controllers\MiddleWares\Refrence\GeneralMiddleWare;

class LoginMiddleWare {
    public function ipCheck() {
        if (Tools::getIp() == 'UNKNOWN') {
            Response::setStatus(400, 'unkonwn ip');
            exit();
        }
    }
}
