<?php

namespace App\Listeners;

use App\Classes\Mail;
use App\Events\PasswordChange;
use App\Models\UserModel;

class PasswordMail {
    public function __construct()
    {
        
    }

    public function handle(PasswordChange $event)
    {
        $userService = $event->getUserService();
        $mail = new Mail();
        $mail->reciever($userService)->subject('forgot password email')->view(SITE_VIEW . "mail/mail.php", PUBLIC_FOLDER)->send();
        $userModel = new UserModel();
        $userModel->updateRememberToken($event->getUserService());
    }
}