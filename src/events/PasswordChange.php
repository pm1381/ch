<?php

namespace App\Events;

use App\Classes\Dispatchable;
use App\Services\User;

class PasswordChange {
    use Dispatchable;

    private $userService;
    

    public function __construct(User $userService, $dataArray)
    {
        $userService->setEmail($dataArray['email']);
        $this->userService = $userService;
    }


    public function getUserService()
    {
        return $this->userService;
    }
}