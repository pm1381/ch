<?php

namespace App\Policies;

use App\Classes\Gate;
use App\Helpers\Tools;
use ReflectionClass;
use ReflectionMethod;

class HandleAuthorization
{
    public function registerPolicies()
    {
        $allFiles = Tools::getFilesInFolder(POLICY, ['HandleAuthorization.php']);
        foreach ($allFiles as $value) {
            $fullName = __NAMESPACE__ . "\\" .  explode(".", $value)[0];
            $refclass = new ReflectionClass($fullName);
            $methods = $refclass->getMethods();
            foreach ($methods as  $method) {
                $name = strtolower(str_replace("App\Policies\\", "", explode("Policy", $method->class)[0])) . "_" . $method->name;
                $refMethod = new ReflectionMethod($method->class, $method->name);
                $closure = $refMethod->getClosure(new $refclass->name);
                Gate::define($name, $closure, 1);
            }
        }
        // print_f(Gate::getAllGates());
    }
}