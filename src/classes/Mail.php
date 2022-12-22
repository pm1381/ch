<?php
namespace App\Classes;

use App\Services\User;
use PHPMailer\PHPMailer\PHPMailer;

class Mail {
        
    public static function sendMail(User $user)
    {
        $phpmailer = new PHPMailer(true);
        try {
            //SETUPS
            $phpmailer->isSMTP();
            $phpmailer->Host = MAIL_HOST;
            $phpmailer->SMTPAuth   = true; 
            $phpmailer->Port = MAIL_PORT;
            $phpmailer->Username = MAIL_USERNAME;
            $phpmailer->Password = MAIL_PASSWORD;
            $phpmailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);

            //RECEPTION
            $phpmailer->addAddress($user->getEmail());

            //content

            $phpmailer->send();
        } catch (\Throwable $th) {
            
        }
    }
}