<?php

namespace App\Controllers\Site\Auth;

use App\Classes\Mail;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Helpers\Input;
use App\Helpers\Tools;
use App\Models\UserModel;
use App\Services\User;

class ForgotPasswordController extends SiteRefrenceController {    
    public function showLinkRequestForm()
    {
        // return the view
    }

    public function reset()
    {
        $dataArray = Input::getDataForm();
        $validateResult = $this->AuthValidation($dataArray, [
            'email' => 'required|email'
        ]);

        if ($validateResult['error'] == false) {
            $userService = new User();
            $userService->setEmail($dataArray['email']);
            $userModel = new UserModel();
            $userModel->updateRememberToken($userService);
            Mail::sendMail();
        } else {
            Tools::setStatus(400, 'email format is wrong');
        }
    }

    public function showResetForm($token)
    {

    }
}