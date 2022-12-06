<?php

namespace App\Policies;

use App\Helpers\Tools;
use ReflectionClass;

class HandleAuthorization
{
    public function registerPolicies()
    {
        $allFiles = Tools::getFilesInFolder(POLICY, ['HandleAuthorization.php']);
        foreach ($allFiles as $value) {
            $value = explode(".", $value)[0];
            $fullName = __NAMESPACE__ . "\\" .  $value;
            $class = new ReflectionClass($fullName);
            $methods = $class->getMethods();
        }
    }
}