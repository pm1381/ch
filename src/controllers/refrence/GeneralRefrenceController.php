<?php

namespace App\Controllers\Refrence;

use App\Helpers\Tools;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use ReflectionClass;
use stdClass;
use Whoops\Run;

class GeneralRefrenceController {
    protected $model = null;
    protected $view = null;

    protected static $controllerLog;


    public function __construct()
    {
        $namespace = explode("\\", $this::class);
        $controllerName = $namespace[count($namespace) - 1];
        $modelName = str_replace("Controller", "", $controllerName);
        $modelNamespace = 'App\\Models\\' . $modelName . "Model";
        if (class_exists($modelNamespace)) {
            $reflectionClass = new ReflectionClass($modelNamespace);
            $newInstance = $reflectionClass->newInstance();
            $this->model = $newInstance;
        }

        self::$controllerLog = new Logger('controller');
        $string = Tools::slashToBackSlash(STORAGE . "log/controller.log");
        self::$controllerLog->pushHandler(new StreamHandler($string));
    }

    protected function makeClassData($dataArray, $className) {
        $reflectionClass = new ReflectionClass($className);
        $newInstance = $reflectionClass->newInstanceWithoutConstructor();
        $userClassProperties = $reflectionClass->getProperties();
        if (count($dataArray) == count($userClassProperties)) {
            $i = 0;
            foreach ($dataArray as $key => $value) {
                foreach($userClassProperties as $prop) {
                    $prop->setAccessible(true);
                    if ($key == $prop->getName()) {
                        $i++;
                        $prop->setValue($newInstance, $value);
                        break;
                    }
                }
            }
            if ($i == count($dataArray)) {
                return $newInstance;
            }
        }
        return '';
    }
}