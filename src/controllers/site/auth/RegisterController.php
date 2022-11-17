<?php

namespace App\Controllers\Site\Auth;

use App\Classes\Validation;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Helpers\Arrays;
use App\Helpers\Input;
use App\Helpers\Tools;
use App\Interfaces\Auth;
use App\Models\UserModel;
use Rakit\Validation\Validator;

class RegisterController extends SiteRefrenceController implements Auth {

    protected $redirectTo = BASE_URI;

    public function AuthCreate()
    {   
    }
    public function AuthValidation($data)
    {   
        $validation = new Validation($data, new Validator(Arrays::errorView()));
        $validation->makeValidation();
        return $validation->handleValidationError();
    }

    public function showRegistrationForm()
    {
        // this one must return a page (only) 
    }

    public function register()
    {
        $dataArray = Input::getDataForm();
        $validateResult = $this->AuthValidation($dataArray);
        if ($validateResult['error'] == false) {
            $this->model = new UserModel();
            // edame bakhshe login
        } else {
            $erros = $validateResult['grabResult'];
        }
        //remember at the end of the request U MUST back to registration form view to see errors
    }


}