<?php
namespace App\Classes;

class User {
    private string $userPhone;
    private string $userName;
 
    /**
     * Get the value of userName
     */ 
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of userPhone
     */ 
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * Set the value of userPhone
     *
     * @return  self
     */ 
    public function setUserPhone($userPhone)
    {
        $this->userPhone = $userPhone;

        return $this;
    }
}