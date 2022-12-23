<?php

namespace App\Listeners;

use App\Classes\Mail;
use App\Events\PasswordChange;
use App\Helpers\Tools;
use App\Models\UserModel;

class PasswordMail {
    public function __construct()
    {
        
    }

    public function handle(PasswordChange $event)
    {
        $userService = $event->getUserService();
        $userService->setRemeberToken(Tools::createCode());
        $realPass = Tools::createCode();
        $hashed = $userService->setPassword($realPass)->hashPassword();
        $replaceWith = [$realPass, $userService->getName()];
        $vars = ['$password', '$userName'];
        $mail = new Mail();
        $mail->reciever($userService)->subject('forgot password email')->view(SITE_VIEW . "mail/mail.php", $vars, $replaceWith)->send();
        $userModel = new UserModel();
        $update1 = $userModel->updateRememberToken($event->getUserService());
        $update2 = $userModel->updatePassword($event->getUserService(), $hashed);
        if ($update1 && $update2) {
            Tools::setStatus(200, "send succesfully");
        } else 
            Tools::setStatus(200, "send unsuccesfully");
    }
}