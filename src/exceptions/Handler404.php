<?php

namespace App\Exceptions;

use App\Helpers\Tools;
use Whoops\Exception\ErrorException;

class Handler404 extends BaseHandler {
    public function __construct(){}

    public function reportError()
    {
        header('HTTP/1.1 404 Not Found');
    }

    public function renderError(array $data)
    {
        // returning 404 view
        Tools::setStatus(404, '404 page not found', $data);
    }
}