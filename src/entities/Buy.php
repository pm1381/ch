<?php
namespace App\Entities;

class Buy extends Entity {
    private int $price;
    private User $user;
    private Insurance $insurance;
    
    /**
     * Get the value of insurance
     */ 
    public function getInsurance()
    {
        return $this->insurance;
    }

    /**
     * Set the value of insurance
     *
     * @return  self
     */ 
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;
        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}