<?php

namespace App\Controllers\Site\Auth;

use App\Interfaces\Auth;
use App\Controllers\Refrence\SiteRefrenceController;

class LoginController extends SiteRefrenceController implements Auth {

    protected $redirectTo = BASE_URI;

    public function create()
    {   
    }
    public function validation()
    {   
    }

    

}