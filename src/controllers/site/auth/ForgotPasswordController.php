<?php

namespace App\Controllers\Site\Auth;

use App\Classes\Mail;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Events\PasswordChange;
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
            $forgotPassEvent = new PasswordChange(new User, $dataArray);
            $forgotPassEvent->dispatch();
        } else {
            Tools::setStatus(400, 'email format is wrong');
        }
    }

    public function showResetForm($token)
    {

    }
}
