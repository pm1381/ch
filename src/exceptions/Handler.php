<?php

namespace App\Exceptions;

use Whoops\Exception\ErrorException;

class Handler extends BaseHandler
{
    public function __construct(){}

    public function reportError($error)
    {
        parent::report($error);
    }

    public function renderError(array $data, $error)
    {
        parent::render($data, $error);
    }
}