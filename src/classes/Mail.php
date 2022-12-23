<?php
namespace App\Classes;

use App\Exceptions\ExceptionMail;
use App\Helpers\Tools;
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
            $this->phpMailer->send();
        } catch (\Exception $e) {
            throw new ExceptionMail($e);
        }
    }

    private function loadConfigs()
    {
        $this->phpMailer->isSMTP();
        $this->phpMailer->Host = MAIL_HOST;
        $this->phpMailer->SMTPAuth   = true; 
        $this->phpMailer->Port = MAIL_PORT;
        $this->phpMailer->Username = MAIL_USERNAME;
        $this->phpMailer->Password = MAIL_PASSWORD;
        $this->phpMailer->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
    }

    public function reciever(User $user)
    {
        $this->phpMailer->addAddress($user->getEmail(), $user->getName());
        return $this;
    }

    public function view($htmFilePath, $vars, $replace)
    {
        // $this->phpMailer->msgHTML(file_get_contents($htmFilePath));
        $message = str_replace($vars, $replace, file_get_contents($htmFilePath));
        $this->phpMailer->msgHTML($message);
        return $this;
    }

    public function text($htmFilePath)
    {
        $this->phpMailer->html2text(file_get_contents($htmFilePath)); 
        return $this;
    }

    

    // it is also possible to add more stuff from phpMailer to the project.
    // but i wanted to keep it simple;

    public function subject($sub)
    {
        $this->phpMailer->Subject = $sub;
        return $this;
    }

    public function encryption()
    {
        if (MAIL_PORT == 465 || MAIL_PORT == 587) {
            MAIL_PORT == 465? $this->phpMailer->SMTPSecure = phpMailer::ENCRYPTION_SMTPS: phpMailer::ENCRYPTION_STARTTLS;
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
