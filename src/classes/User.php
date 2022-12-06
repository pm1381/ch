<?php
namespace App\Classes;


use App\Models\UserModel;
use Ghostff\Session\Session;

class User {
    private string $email = '';
    private string $name = '';
    private string $password = '';
    private string $token = '';
    private int $admin = 1;
    private int $id;
    
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
        //password_verify($password, $hashed_password)
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function isLogin()
    {
        $data['login'] = false;
        $session = new Session();
        if ($session->exist('userId')) {
            $token = $session->get('userId');
            $userModel = new UserModel();
            $result = $userModel->getByToken($token);
            if (count($result)) {
                $data['login'] = true;
                $data['user'] = $result[0];
            }
        }
        return $data;
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

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of admin
     */ 
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @return  self
     */ 
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}