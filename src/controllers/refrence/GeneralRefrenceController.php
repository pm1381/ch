<?php

namespace App\Controllers\Refrence;

use Monolog\Logger;
use ReflectionClass;
use App\Classes\Gate;
use App\Entities\User;
use App\Helpers\Tools;
use App\Exceptions\Exception403;
use Monolog\Handler\StreamHandler;

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

    protected function authorize($name, ...$params)
    {
        $result = false;
        if (array_key_exists($name, Gate::getAllGates())) {
            $closure = Gate::getAllGates()[$name]['closure'];
            $user = new User();
            $check = $user->isLogin();
            $loginUser = $check['user'];
            $logincheck = $check['login'];
            if ($logincheck && Gate::getAllGates()[$name]['type'] == 0) {
                array_unshift($params, $loginUser);
            }
            $result = call_user_func_array($closure, $params);
        }
        if (! $result) {
            throw new Exception403('unauthorized move');
        }
    }
}