<?php

namespace App\Controllers\MiddleWares\Site;

use App\Controllers\MiddleWares\Refrence\GeneralMiddleWare;
use App\Helpers\Tools;

class LoginMiddleWare extends GeneralMiddleWare {
    public function ipCheck() {
        if (Tools::getIp() == 'UNKNOWN') {
            Tools::setStatus(400, 'unkonwn ip');
            exit();
        }
    }
}