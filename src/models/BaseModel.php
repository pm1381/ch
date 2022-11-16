<?php
namespace App\Models;

use App\Helpers\Tools;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

trait BaseModel {

    protected $queryCount;
    protected $queryResult;

    protected static $modelLog;

    public function __construct()
    {
        self::$modelLog = new Logger('model');
        $string = Tools::slashToBackSlash(STORAGE . "log/model.log");
        self::$modelLog->pushHandler(new StreamHandler($string));
    }

    public function getCount() {
        return $this->queryCount;
    }

    public function getResult() {
        return $this->queryResult;
    }

}