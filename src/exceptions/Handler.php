<?php

namespace App\Exceptions;

use Whoops\Exception\ErrorException;

class Handler extends BaseHandler
{
    public function __construct(){}

    public function report($error)
    {
        parent::report($error);
    }

    public function render(array $data, $error)
    {
        parent::render($data, $error);
    }
}