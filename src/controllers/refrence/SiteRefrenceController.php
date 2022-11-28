<?php

namespace App\Controllers\Refrence;

class SiteRefrenceController extends GeneralRefrenceController {
    
    protected $redirectTo = BASE_URI;
    
    public function __construct()
    {
        parent::__construct();
    }
}