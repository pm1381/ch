<?php

namespace App\Controllers\Site\Auth;

use App\Helpers\Input;
use App\Entities\User;
use App\Classes\Response;
use App\Events\PasswordChange;
use App\Controllers\Refrence\SiteRefrenceController;

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
            Response::setStatus(400, 'email format is wrong');
        }
    }

    public function showResetForm($token)
    {

    }
}
