<?php

namespace App\Configs;

use App\Helpers\Tools;
use ReflectionClass;
use ReflectionMethod;

class Application
{
    public function run()
    {
        $allFiles = Tools::getFilesInFolder(PROVIDER);
        foreach ($allFiles as $value) {
            $fullName = __NAMESPACE__ . "\\" .  explode(".", $value)[0];
            $refclass = new ReflectionClass($fullName);
            $methods = $refclass->getMethods();
            foreach ($methods as  $method) {
                if ($method->name == 'register') {
                    $registers = ['method' => $method->name, "class" => $method->class];
                }

                if ($method->name == 'boot') {
                    $boots = ['method' => $method->name, "class" => $method->class];
                }
            }
        }
        foreach ($registers as $value) {
            $refMethod = new ReflectionMethod($value['class'], $value['method']);
            $closure = $refMethod->getClosure(new $value['class']);
        }
        foreach ($boots as $value) {
            $refMethod = new ReflectionMethod($value['class'], $value['method']);
            $closure = $refMethod->getClosure(new $value['class']);
        }
    }
}
?>
