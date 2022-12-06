<?php

namespace App\Classes;

use App\Exceptions\ExceptionExistBefore;
use App\Helpers\Tools;
use App\Models\UserModel;

class Gate
{
    private static array $allGates = [];

    public static function define($name, $closure, $type = 0)
    {
        // type = 0 means we will insert loged-in user to closure automatically.
        if (! array_key_exists($name, self::$allGates)) {
            self::$allGates[$name] = [
                'closure' => $closure,
                'type' => $type
            ];
        } else {
            throw new ExceptionExistBefore('gate existed before');
        }
    }

    public static function before($closure, $name = '*')
    {
        if ($name != "*") {
            if (array_key_exists($name, self::$allGates)) {
                self::$allGates[$name]['before'] = $closure;
            }
        } else {
            foreach (self::$allGates as $name => $gateArray) {
                $gateArray['before'] = $closure;
            }
        }
    }

    public static function after($closure, $name='*')
    {
        if ($name != "*") {
            if (array_key_exists($name, self::$allGates)) {
                self::$allGates[$name]['after'] = $closure;
            }
        } else {
            foreach (self::$allGates as $name => $gateArray) {
                $gateArray['after'] = $closure;
            }
        }
    }

    public static function allows($name, ...$params)
    {
        if (array_key_exists($name, self::$allGates)) {
            $closure = self::$allGates[$name]['closure'];
            $user = new User();
            $logeedIn = $user->isLogin();
            $loginCheck = $logeedIn['login'];
            $loginUser = $logeedIn['user'];
            if (self::manageBefore($loginUser, $name, $params)) {
                if ($loginCheck && self::$allGates[$name]['type'] == 0) {
                    array_unshift($params, $loginUser);
                }
                $result = call_user_func_array($closure, $params);
                return self::manageAfter($loginUser, $name, $params, $result);
            }
        }
        return false;
    }

    public static function manageAfter($user, $name, $params, $result)
    {
        if (array_key_exists('after', self::$allGates[$name])) {
            $afterClosure = self::$allGates[$name]['after'];
            return call_user_func_array($afterClosure, [$user, $name, $params, $result]);
        }
        return $result;
    }

    public static function getAllGates()
    {
        if (count(self::$allGates) == 0) {
            return [];
        }
        return self::$allGates;
    }

    public static function manageBefore($user, $name, $params)
    {
        if (array_key_exists('before', self::$allGates[$name])) {
            $beforeClosure = self::$allGates[$name]['before'];
            return call_user_func_array($beforeClosure, [$user, $name, $params]);
        }
        return true;
    }
}