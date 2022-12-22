<?php
namespace App\Classes;

use App\Exceptions\ExceptionMail;
use App\Services\User;
use PHPMailer\PHPMailer\PHPMailer;

class Mail {
    private $phpMailer;

    public function __construct()
    {
        try {
            $this->phpMailer = new PHPMailer(true);
            $this->loadConfigs();
        } catch (\Exception $e) {
            throw new ExceptionMail($e);
        }
    }
        
    public function send()
    {
        try {
            $this->phpmailer->send();
        } catch (\Exception $e) {
            throw new ExceptionMail($e);
        }
    }

    private function loadConfigs()
    {
        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = MAIL_HOST;
        $this->phpmailer->SMTPAuth   = true; 
        $this->phpmailer->Port = MAIL_PORT;
        $this->phpmailer->Username = MAIL_USERNAME;
        $this->phpmailer->Password = MAIL_PASSWORD;
        $this->phpmailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
    }

    public function reciever(User $user)
    {
        // $user->getEmail(); $user->getName();
        $this->phpmailer->addAddress('parham.minou@gmail.com', 'parham');
        return $this;
    }

    public function view($htmFilePath, $imagesPath="")
    {
        $this->phpMailer->msgHTML(file_get_contents($htmFilePath));
        return $this;
    }

    public function text($htmFilePath)
    {
        $this->phpMailer->html2text(file_get_contents($htmFilePath)); 
        return $this;
    }

    

    // it is also possible to add more stuff from PHPMailer to the project.
    // but i wanted to keep it simple;

    public function subject($sub)
    {
        $this->phpMailer->Subject = $sub;
        return $this;
    }

    public function encryption()
    {
        if (MAIL_PORT == 465 || MAIL_PORT == 587) {
            MAIL_PORT == 465? $this->phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS: PHPMailer::ENCRYPTION_STARTTLS;
        }
        return $this;
    }

    public function WordWrap($count)
    {
        $this->phpMailer->WordWrap = $count;
        return $this;
    }

    public function altBody($text)
    {
        $this->phpMailer->AltBody = $text;
        return $this;
    }

    public function addOptions($optionsArray)
    {
        // $this->phpMailer->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
        $this->phpMailer->SMTPOptions = $optionsArray;
        return $this;
    }

    public function attachment($path)
    {
        $this->phpMailer->addAttachment($path);
        return $this;
    }
}
