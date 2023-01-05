<?php
namespace App\Entities;

use App\Classes\Jwt;
use App\Classes\Gate;
use DateTimeImmutable;
use App\Classes\Cookie;
use App\Classes\Session;
use App\Models\UserModel;

class User extends Entity {
    private string $email = '';
    private int $phoneNumber;
    public string $name = '';
    private string $password = '';
    private string $token = '';
    private int $admin = 1;
    private string $remeberToken = '';
    private int $inviteRemain = 10;
    private string $inviteCode;
    private User $invitedFrom;
    
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return htmlentities($this->name);
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
        return  htmlentities($this->email);
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
        return htmlentities($this->password);
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function hashPassword()
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function checkPassword($password, $hashed)
    {
        return password_verify($password, $hashed);
    }

    public function isLogin()
    {
        $data['login'] = false;
        $session = new Session();
        if ($session->exists('userId')) {
            $token = $session->get('userId');
            $userModel = new UserModel();
            $result = $userModel->getByFieldName('token', $token);
            if (count($result)) {
                $data['login'] = true;
                $data['user'] = $result[0];
            }
        }
        return $data;
    }

    public function isLoginJwt()
    {
        $data['login'] = false;
        $cookie = new Cookie();
        $jwtString = $cookie->get('jwtToken');
        if ($jwtString != null) {
            $now = new DateTimeImmutable();
            $jwt = new Jwt();
            $result = $jwt->get($jwtString);
            
            if ($result->iss == DOMAIN && $result->nbf < $now->getTimestamp() && $result->exp > $now->getTimestamp()) {
                $data['login'] = true;
                $data['user'] = $result->data;
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
     * Get the value of remeberToken
     */ 
    public function getRemeberToken()
    {
        return $this->remeberToken;
    }

    /**
     * Set the value of remeberToken
     *
     * @return  self
     */ 
    public function setRemeberToken($remeberToken)
    {
        $this->remeberToken = $remeberToken;
        return $this;
    }

    /**
     * Get the value of phoneNumber
     */ 
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @return  self
     */ 
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Get the value of invitedFrom
     */ 
    public function getInvitedFrom()
    {
        return $this->invitedFrom;
    }

    /**
     * Set the value of invitedFrom
     *
     * @return  self
     */ 
    public function setInvitedFrom($invitedFrom)
    {
        $this->invitedFrom = $invitedFrom;
        return $this;
    }

    /**
     * Get the value of inviteCode
     */ 
    public function getInviteCode()
    {
        return $this->inviteCode;
    }

    /**
     * Set the value of inviteCode
     *
     * @return  self
     */ 
    public function setInviteCode($inviteCode)
    {
        $this->inviteCode = $inviteCode;
        return $this;
    }

    /**
     * Get the value of inviteRemain
     */ 
    public function getInviteRemain()
    {
        return $this->inviteRemain;
    }

    /**
     * Set the value of inviteRemain
     *
     * @return  self
     */ 
    public function setInviteRemain($inviteRemain)
    {
        $this->inviteRemain = $inviteRemain;
        return $this;
    }
}