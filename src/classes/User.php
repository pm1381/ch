<?php
namespace App\Classes;

use App\Helpers\Tools;
use App\Models\UserModel;
use Ghostff\Session\Session;

class User {
    private string $email = '';
    private string $name = '';
    private string $password = '';
    
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = Tools::createSalt($password);
        return $this;
    }

    public function isLogin()
    {
        $session = new Session();
        if ($session->exist('userId')) {
            $sessionData = $session->get('userId');
            return true;
        }
        return false;
    }

    public function canDo($name,$userId, ...$params)
    {
        if (array_key_exists($name, Gate::getAllGates())) {
            $closure = Gate::getAllGates()[$name]['closure'];
            $user = new UserModel();
            $result = $user->getById($userId);
            if (Gate::getAllGates()[$name]['type'] == 0) {
                array_unshift($params, $result);
            } else {
                $params[] = $result;
            }
            return call_user_func_array($closure, $params);
        }
        return false;
    }
}