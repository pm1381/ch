<?php

namespace App\Controllers\Site\Auth;

use App\Interfaces\Auth;
use App\Controllers\Refrence\SiteRefrenceController;

class LoginController extends SiteRefrenceController implements Auth {    
    public function authValidation($data)
    {
        
    }

    public function showLoginForm()
    {
        // returning related view
    }

    public function login()
    {

    }

    public function logout()
    {

    }

}